<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RevokeLogin extends Notification {
    use Queueable;

    public function __construct(

    ) {
    }

    public function via(object $notifiable): array {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
                    ->line('We noticed a login in to your account.')
                    ->line('If this activity is not your own operation, Please revoke all logins now.')
                    ->action('Revoke Login', url('http://localhost:5173/'.$notifiable->id.'/revoke-logins'))
                    ->line('Thank you for using our application!');
    }
}
