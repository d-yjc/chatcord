<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'reactionable_id',
        'reactionable_type',
        'chat_user_id',
    ];

    public function reactionable()
    {
        return $this->morphTo();
    }

    public function chatUser()
    {
        return $this->belongsTo(ChatUser::class, 'chat_user_id');
    }
}
