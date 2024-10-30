<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    use HasFactory;

    /**
     * Get the user that posted this post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatUser()
    {
        return $this->belongsTo(ChatUser::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    
}
