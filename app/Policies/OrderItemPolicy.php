<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_order_item');
    }

    public function view(User $user, OrderItem $orderItem): bool
    {
        return $user->can('view_order_item');
    }

    public function create(User $user): bool
    {
        return $user->can('create_order_item');
    }

    public function update(User $user, OrderItem $orderItem): bool
    {
        return $user->can('update_order_item');
    }

    public function delete(User $user, OrderItem $orderItem): bool
    {
        return $user->can('delete_order_item');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_order_item');
    }

    public function forceDelete(User $user, OrderItem $orderItem): bool
    {
        return $user->can('force_delete_order_item');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_order_item');
    }

    public function restore(User $user, OrderItem $orderItem): bool
    {
        return $user->can('restore_order_item');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_order_item');
    }

    public function replicate(User $user, OrderItem $orderItem): bool
    {
        return $user->can('replicate_order_item');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_order_item');
    }
}
