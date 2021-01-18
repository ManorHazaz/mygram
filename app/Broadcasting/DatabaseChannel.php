<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Notifications\Notification;

class DatabaseChannel 
{

  public function send($notifiable, Notification $notification)
  {
    $data = $notification->toDatabase($notifiable);

    return $notifiable->routeNotificationFor('database')->create([
        'id' => $notification->id,

        //customize here
        'user_id' => auth()->user()->id,

        'type' => get_class($notification),
        'data' => $data,
        'read_at' => null,
    ]);
  }

}
