<?php

namespace App\Policies;

use App\Models\ChatUser;
use Illuminate\Auth\Access\Response;

class ChatUserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(ChatUser $editor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(ChatUser $editor, ChatUser $targetUser): bool
    {
        return true; 
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(ChatUser $editor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(ChatUser $editor, ChatUser $targetUser): bool
    {
        return $editor->id === $targetUser->id 
        || $editor->hasExistingRole('admin')
        || $editor->hasExistingRole('moderator');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(ChatUser $editor, ChatUser $targetUser): bool
    {
        return $editor->id === $targetUser->id || $editor->hasExistingRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(ChatUser $editor, ChatUser $targetUser): bool
    {
        return false; 
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(ChatUser $editor, ChatUser $targetUser): bool
    {
        return $editor->hasRole('admin');
    }
}
