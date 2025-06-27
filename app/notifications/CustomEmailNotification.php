<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmailNotification extends VerifyEmail
{
    /**
     * Get the verification URL for the given notifiable.
     */
    protected function verificationUrl($notifiable)
    {
        $prefix = config('app.frontend_url') ? config('app.frontend_url') . '/email/verify' : config('app.url') . '/api/email/verify';

        $temporarySignedURL = URL::temporarySignedRoute(
            'verification.verify.get',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        // Se você tem um frontend, pode querer construir a URL de forma diferente
        return $temporarySignedURL;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verificar Endereço de Email')
            ->greeting('Olá!')
            ->line('Clique no botão abaixo para verificar seu endereço de email.')
            ->action('Verificar Email', $verificationUrl)
            ->line('Se você não criou uma conta, nenhuma ação adicional é necessária.')
            ->salutation('Atenciosamente, ' . config('app.name'));
    }
}