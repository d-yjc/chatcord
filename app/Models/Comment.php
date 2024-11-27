<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function chatUser()
    {
        return $this->belongsTo(ChatUser::class, 'chat_user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }
}
