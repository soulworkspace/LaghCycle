<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // عرض السلة
    public function index()
    {
        $cart = Session::get('trico_cart', []);
        $total = 0;
        $unavailableItems = false;

        foreach ($cart as $key => $item) {
            if (! is_array($item)) {
                unset($cart[$key]);
                $unavailableItems = true;
                continue;
            }

            $product = Ad::active()->find($item['id'] ?? 0);

            if (! $product) {
                unset($cart[$key]);
                $unavailableItems = true;
                continue;
            }

            $cart[$key] = array_merge($item, [
                'title' => $product->title,
                'price' => $product->price,
                'seller_id' => $product->user_id,
                'image' => $product->primaryImage?->image_path ?? 'default.jpg',
                'size' => $item['size'] ?? 'Standard',
                'color' => $item['color'] ?? 'N/A',
                'quantity' => max(1, min(99, (int) ($item['quantity'] ?? 1))),
            ]);
            $total += (float) $product->price * (int) ($cart[$key]['quantity'] ?? 1);
        }

        Session::put('trico_cart', $cart);
        if ($unavailableItems) {
            Session::flash('warning', 'تمت إزالة منتجات لم تعد متاحة من سلة التسوق.');
        }

        return view('cart.index', compact('cart', 'total', 'unavailableItems'));
    }

    // إضافة منتج للسلة
    public function add(Request $request, $id)
    {
        $this->addProductToCart($request, $id);

        return redirect()->route('cart.index')->with('success', 'تمت الإضافة لسلة تريكو!');
    }

    public function buyNow(Request $request, int $id)
    {
        $this->addProductToCart($request, $id);

        return redirect()->route('checkout.index');
    }

    private function addProductToCart(Request $request, int $id): void
    {
        $validated = $request->validate([
            'size' => ['nullable', 'string', 'max:50'],
            'color' => ['nullable', 'string', 'max:50'],
        ]);
        $product = Ad::active()->findOrFail($id);
        $size = $validated['size'] ?? 'Standard';
        $color = $validated['color'] ?? 'N/A';
        $cart = Session::get('trico_cart', []);
        $cartKey = $id . '_' . md5($size . '|' . $color);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] = min(99, (int) $cart[$cartKey]['quantity'] + 1);
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'title' => $product->title,
                'quantity' => 1,
                'price' => $product->price,
                'size' => $size,
                'color' => $color,
                'seller_id' => $product->user_id,
                'image' => $product->primaryImage?->image_path ?? 'default.jpg',
            ];
        }

        Session::put('trico_cart', $cart);
    }

    // حذف منتج
    public function remove($key)
    {
        $cart = Session::get('trico_cart', []);
        if(isset($cart[$key])) {
            unset($cart[$key]);
            Session::put('trico_cart', $cart);
        }
        return back()->with('success', 'تم حذف القطعة');
    }
}