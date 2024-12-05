<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.ChatUser.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
