<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_organization');
    }

    public function view(User $user, Organization $organization): bool
    {
        return $user->can('view_organization');
    }

    public function create(User $user): bool
    {
        return $user->can('create_organization');
    }

    public function update(User $user, Organization $organization): bool
    {
        return $user->can('update_organization');
    }

    public function delete(User $user, Organization $organization): bool
    {
        return $user->can('delete_organization');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_organization');
    }

    public function forceDelete(User $user, Organization $organization): bool
    {
        return $user->can('force_delete_organization');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_organization');
    }

    public function restore(User $user, Organization $organization): bool
    {
        return $user->can('restore_organization');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_organization');
    }

    public function replicate(User $user, Organization $organization): bool
    {
        return $user->can('replicate_organization');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_organization');
    }
}
