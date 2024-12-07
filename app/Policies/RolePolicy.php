<?php

namespace App\Policies;

use App\Models\ChatUser;
use App\Models\Role;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(ChatUser $chatUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(ChatUser $chatUser, Role $role): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(ChatUser $chatUser): bool
    {
        return $chatUser->hasExistingRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(ChatUser $chatUser, Role $role): bool
    {
        return $chatUser->hasExistingRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(ChatUser $chatUser, Role $role): bool
    {
        return $chatUser->hasExistingRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(ChatUser $chatUser, Role $role): bool
    {
        return $chatUser->hasExistingRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(ChatUser $chatUser, Role $role): bool
    {
        return false;
    }
}
