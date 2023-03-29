<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPassword extends Notification {
    use Queueable;

    public function __construct(

    ) {
    }

    public function via(object $notifiable): array {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
            ->from('secureLMS@gmail.com', 'secureLMS')
            ->line('Use this code to prove its your email.')
            ->line('We will help you change your password thereafter.')
            ->line('Your two factor code is '.$notifiable->twoFactorCode)
            ->line('This code will expire in 10 minutes.');
    }
}
