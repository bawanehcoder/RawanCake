<?php

namespace App\Notifications;

use App\Notifications\Formatter\OccasionNotificationFormatter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OccasionNotify extends Notification
{
    use Queueable;
    public $formatter;
    public $entity;

    /**
     * Create a new notification instance.
     */
    public function __construct($entity)
    {
        $this->entity=$entity;
        $this->formatter = app()->make(OccasionNotificationFormatter::class, ['entity' => $entity]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $via = [];
        // db
        $via[] = 'database';
//        $via[] = 'mail';
        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {

        return [
            'entity_id'=>$this->entity->id,
            'entity_type'=>'Occasion'
        ];
    }
}
