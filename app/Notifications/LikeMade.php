<?php

namespace App\Notifications;

use App\Models\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeMade extends Notification
{
    use Queueable;
    public $fullName;
    /**
     * Create a new notification instance.
     */
    public function __construct(private Like $like)
    {
        //
        $this->fullName = $this->like->user->first_name . ' ' . $this->like->user->last_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Like on your post')
                    ->line($this->fullName.' Liked your post')
                    ->action('Post', url('/post/'.$this->like->post_id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [ 
            //
            'postId' => $this->like->post_id,
            'userName' => $this->fullName,
        ];
    }
}
