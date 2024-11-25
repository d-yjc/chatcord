<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function chatUsers() {
        return $this->belongsToMany(ChatUser::class, 'chat_user_role')->withTimestamps();
    }
}
