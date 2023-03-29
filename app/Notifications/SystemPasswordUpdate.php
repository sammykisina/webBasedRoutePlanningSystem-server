<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SystemPasswordUpdate extends Notification {
    use Queueable;

    public function __construct(

    ) {
    }

    public function via(object $notifiable): array {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
                    ->line('We have updated your password.')
                    ->line('Use your workId/Reg Number for both workId/regNumber and password in your login page to login')
                    ->line('You can the update the password to your prepared choice after login.');
    }
}
