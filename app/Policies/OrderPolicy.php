<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_order');
    }

    public function view(User $user, Order $order): bool
    {
        return $user->can('view_order');
    }

    public function create(User $user): bool
    {
        return $user->can('create_order');
    }

    public function update(User $user, Order $order): bool
    {
        return $user->can('update_order');
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->can('delete_order');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_order');
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return $user->can('force_delete_order');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_order');
    }

    public function restore(User $user, Order $order): bool
    {
        return $user->can('restore_order');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_order');
    }

    public function replicate(User $user, Order $order): bool
    {
        return $user->can('replicate_order');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_order');
    }
}
