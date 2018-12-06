<?php



namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;

class CustomEmailVerified extends VerifyEmail
{
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('貓咪書店認證郵件'))
            ->line(Lang::getFromJson('請按下以下按鈕以認證您的郵件'))
            ->action(
                Lang::getFromJson('Email 認證'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('如果您未創立帳戶，請忽略這封信'));
    }

}
