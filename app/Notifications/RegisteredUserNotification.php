<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredUserNotification extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new notification instance.
     */
    public function __construct(public String $password)
    {
        $this->password = $password;
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
        return (new MailMessage)
            ->subject(__('Registro en :platform', ['platform' => env('APP_NAME')]))
            ->greeting(__('Registro de usuario'))
            ->line(__('Cordial saludo, **:userName**', ['userName' => $notifiable->name]))
            ->line(__('Le damos la bienvenida a nuestra plataforma :platform', ['platform' => env('APP_NAME')]))
            ->line(__('Te adjundamos las credenciales para ingresar a nuestra plataforma; se recomienda cambiar la contraseña al iniciar sesión'))
            ->line(__('- **Usuario:** :email', ['email' => $notifiable->email]))
            ->line(__('- **Contraseña:** :password', ['password' => $this->password]))
            ->action(__('Iniciar sesión'), url(route('login')))
            ->line(__('Gracias por registrarte en nuestra plataforma!'));
    }

    /**
     * Determine the notification's delivery delay.
     *
     * @return array<string, \Illuminate\Support\Carbon>
     */
    public function withDelay(object $notifiable): array
    {
        return [
            'mail' => now()->addMinutes(2),
        ];
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
}
