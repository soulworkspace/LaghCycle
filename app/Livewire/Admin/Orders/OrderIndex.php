<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component 
{
    use WithPagination;

    public string $search = '';
    public array $statuses = [];
    
    // متغيرات التحكم في النافذة المنسدلة (Modal)
    public bool $showStatusModal = false;
    public ?int $selectedOrderId = null;
    public string $selectedStatus = '';
    public string $statusNote = '';

    public function mount(): void
    {
        $this->authorizeAdmin();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    // فتح القائمة/النافذة المنسدلة للتأكيد
    public function openStatusModal(int $orderId): void
    {
        $this->authorizeAdmin();

        $this->selectedOrderId = $orderId;
        $this->selectedStatus = $this->statuses[$orderId] ?? 'pending';
        $this->statusNote = '';
        $this->showStatusModal = true;
    }

    // إغلاق النافذة المنسدلة
    public function closeModal(): void
    {
        $this->showStatusModal = false;
        $this->selectedOrderId = null;
        $this->statusNote = '';
    }

    // حفظ التحديث بعد التأكيد في النافذة المنسدلة
    public function confirmUpdateStatus(): void
    {
        $this->authorizeAdmin();

        if (!$this->selectedOrderId) {
            return;
        }

        $allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'completed', 'cancelled'];
        
        if (!in_array($this->selectedStatus, $allowedStatuses, true)) {
            $this->dispatch('status-error', message: 'الحالة المحددة غير صالحة.');
            return;
        }

        $order = Order::findOrFail($this->selectedOrderId);

        try {
            DB::transaction(function () use ($order) {
                $order->update(['status' => $this->selectedStatus]);

                OrderStatusHistory::create([
                    'order_id' => $order->id,
                    'user_id'  => auth()->id(),
                    'status'   => $this->selectedStatus,
                    'note'     => $this->statusNote ?: null,
                ]);
            });

            $this->statuses[$this->selectedOrderId] = $this->selectedStatus;
            $this->dispatch('status-updated', message: "تم تحديث حالة الطلب #{$order->id} بنجاح.");
            
            $this->closeModal();

        } catch (\Throwable $exception) {
            report($exception);
            $this->dispatch('status-error', message: 'حدث خطأ أثناء تحديث حالة الطلب.');
        }
    }

    public function render()
    {
        $this->authorizeAdmin();

        $orders = Order::with(['buyer', 'statusHistories.user'])
            ->when($this->search !== '', function ($query) {
                $search = '%' . addcslashes($this->search, '%_') . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'like', $search)
                      ->orWhere('city', 'like', $search)
                      ->orWhere('phone', 'like', $search)
                      ->orWhereHas('buyer', fn ($buyer) => $buyer->where('name', 'like', $search));
                });
            })
            ->latest()
            ->paginate(10);

        foreach ($orders as $order) {
            if (!array_key_exists($order->id, $this->statuses)) {
                $this->statuses[$order->id] = $order->status;
            }
        }

        return view('livewire.admin.orders.order-index', [
            'orders' => $orders
        ])->layout('layouts.admin'); 
    }

    private function authorizeAdmin(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);
    }
}