<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'topic',
        'body',
    ];

    /**
     * Get the user that posted this post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatUser()
    {
        return $this->belongsTo(ChatUser::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function attachment() 
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }
    
}
