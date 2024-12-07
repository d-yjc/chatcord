<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ChatUser extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'chat_user_role')->withTimestamps();
    }

    public function assignRole(Role $role) {
        return $this->roles()->attach($role->id);
    }

    public function removeRole(Role $role)
    {
        return $this->roles()->detach($role->id);
    }

    public function hasExistingRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
}
