<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * عرض صفحة إتمام الشراء
     */
    public function index(Request $request)
    {
        $cart = $request->session()->get('trico_cart', []);

        if ($cart === []) {
            return redirect()->route('cart.index')->with('error', 'سلة التسوق فارغة.');
        }

        $total = 0;
        foreach ($cart as $key => $item) {
            abort_unless(is_array($item) && isset($item['id']), 422, 'Invalid cart item.');
            $ad = Ad::active()->findOrFail($item['id']);
            $quantity = filter_var($item['quantity'] ?? null, FILTER_VALIDATE_INT);
            abort_if($quantity === false || $quantity < 1 || $quantity > 99, 422, 'Invalid cart quantity.');
            abort_if($ad->price === null && $ad->price_type !== 'free', 422, 'This listing has no fixed checkout price.');
            abort_if((int) $ad->user_id === (int) Auth::id(), 422, 'You cannot order your own listing.');

            $cart[$key] = array_merge($item, [
                'title' => $ad->title,
                'price' => $ad->price,
                'seller_id' => $ad->user_id,
                'image' => $ad->primaryImage?->image_path ?? 'default.jpg',
                'quantity' => $quantity,
                'size' => $item['size'] ?? 'Standard',
                'color' => $item['color'] ?? 'N/A',
            ]);
            $total += (float) ($ad->price ?? 0) * $quantity;
        }

        $request->session()->put('trico_cart', $cart);

        return view('checkout.index', compact('cart', 'total'));
    }

    /**
     * حفظ الطلب في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:15'],
            'city' => ['required', 'string', 'max:100'],
            'shipping_address' => ['required', 'string', 'min:10', 'max:2000'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $cart = $request->session()->get('trico_cart', []);

        if ($cart === []) {
            return redirect()->route('cart.index')->with('error', 'سلة التسوق فارغة.');
        }

        DB::transaction(function () use ($cart, $validated): void {
            foreach ($cart as $item) {
                abort_unless(is_array($item) && isset($item['id']), 422, 'Invalid cart item.');
                $ad = Ad::active()->findOrFail($item['id']);
                $quantity = filter_var($item['quantity'] ?? null, FILTER_VALIDATE_INT);
                abort_if($quantity === false || $quantity < 1 || $quantity > 99, 422, 'Invalid cart quantity.');
                abort_if($ad->price === null && $ad->price_type !== 'free', 422, 'This listing has no fixed checkout price.');
                abort_if((int) $ad->user_id === (int) Auth::id(), 422, 'You cannot order your own listing.');

                $order = Order::create([
                    'buyer_id' => Auth::id(),
                    'listing_id' => $ad->id,
                    'seller_id' => $ad->user_id,
                    'size' => $item['size'] ?? 'Standard',
                    'color' => $item['color'] ?? 'N/A',
                    'quantity' => $quantity,
                    'total_price' => (float) ($ad->price ?? 0) * $quantity,
                    'status' => 'pending',
                    'phone' => $validated['phone'],
                    'city' => $validated['city'],
                    'shipping_address' => $validated['shipping_address'],
                    'notes' => $validated['notes'] ?? null,
                ]);

                OrderStatusHistory::create([
                    'order_id' => $order->id,
                    'user_id' => Auth::id(),
                    'status' => 'pending',
                ]);
            }
        });

        $request->session()->forget('trico_cart');

        return redirect()->route('checkout.success');
    }


    public function success()
    {
        return view('checkout.success');
    }

    /**
     * تحديث حالة الطلب (خاص بالبائع)
     */
    public function updateStatus(Request $request, Order $order)
    {
        // التحقق أن المستخدم الحالي هو البائع الفعلي لهذا الطلب
        if (Auth::id() !== $order->seller_id) {
            abort(403, 'غير مصرح لك بتعديل هذا الطلب.');
        }

        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled'
        ]);

        if ($order->status === $request->status) {
            return back()->with('success', 'حالة الطلب لم تتغير.');
        }

        DB::transaction(function () use ($order, $request) {
            $order->update(['status' => $request->status]);
            OrderStatusHistory::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'status' => $request->status,
            ]);
        });

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }

    /**
     * عرض طلبات المشتري (طلباتي)
     */
    public function myOrders()
    {
        $orders = Order::where('buyer_id', Auth::id())
            ->with(['listing' => function($q) {
                $q->withTrashed(); // لجلب البيانات حتى لو حُذف الإعلان
            }, 'statusHistories.user'])
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * عرض طلبات الزبائن (لوحة البائع)
     */
    public function vendorOrders()
    {
        $orders = Order::where('seller_id', Auth::id())
            ->with(['listing' => function($q) {
                $q->withTrashed();
            }, 'buyer'])
            ->latest()
            ->get();

        return view('vendor.orders.index', compact('orders'));
    }
}