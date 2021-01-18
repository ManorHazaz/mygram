<?php

namespace App\Notifications;

use App\Broadcasting\CustomDbChannel;
use App\Broadcasting\DatabaseChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class likeNotification extends Notification
{
    use Queueable;

    public $user , $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user , $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DatabaseChannel::class];
        // return ['database'];
    }

    public function toDatabase()
    {
        return [
            'post_id' => $this->post->id,
        ];
    }

    // public function user($user)
    // {
    //     return  User::find('user_id', $user->id);
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
