<?php

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{user_id}', function (User $sender, $message_id, User $receiver) {
    return true;
});