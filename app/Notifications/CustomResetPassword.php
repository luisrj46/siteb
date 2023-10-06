<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class CustomResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;
    private $url, $count;
    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $this->count = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
        return (new MailMessage)
            ->subject('Restablecimiento de contraseña.')
            ->line('Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.')
            ->action('Cambiar contraseña', $this->signedUrl($notifiable->email,$this->count))
            ->line(__('Este enlace de restablecimiento de contraseña caducará en :count minutos.', ['count' => $this->count]))
            ->line('Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.');
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
        ];
    }

    private function signedUrl($email,$minutes)
    {
        return URL::temporarySignedRoute(
            'password.reset', now()->addMinutes($minutes), ['token' => $this->token, 'email' => $email]
        );
    }
}
