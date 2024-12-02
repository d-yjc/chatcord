<?php

namespace App\Policies;

use App\Models\ChatUser;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(ChatUser $chatUser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(ChatUser $chatUser, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(ChatUser $chatUser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(ChatUser $chatUser, Post $post): bool
    {
        return $chatUser->id === $post->chat_user_id
        || $chatUser->hasExistingRole('admin')
        || $chatUser->hasExistingRole('moderator');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(ChatUser $chatUser, Post $post): bool
    {
        return $chatUser->id === $post->chat_user_id
        || $chatUser->hasExistingRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(ChatUser $chatUser, Post $post): bool
    {
        return $chatUser->id === $post->chat_user_id
        || $chatUser->hasExistingRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(ChatUser $chatUser, Post $post): bool
    {
        return $chatUser->hasExistingRole('admin');
    }
}
