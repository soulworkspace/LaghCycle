<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Order $order): bool
    {
        return ($user->isBuyer() && $order->buyer_id === $user->id)
            || ($user->isVendor() && $order->seller_id === $user->id);
    }

    public function update(User $user, Order $order): bool
    {
        return $user->isVendor() && $order->seller_id === $user->id;
    }
}