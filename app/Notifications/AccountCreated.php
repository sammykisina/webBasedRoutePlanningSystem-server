<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreated extends Notification {
    use Queueable;

    public function __construct() {
    }

    public function via(object $notifiable): array {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
                    ->line('Welcome '.$notifiable->name.' to secureLMS')
                    ->line('Your account was created by the admin.')
                    ->line('Use your workId/Reg Number for both workId/regNumber and password in your login page to login');
    }
}
