<?php

namespace App\Notifications\Maintenance;

use App\Models\Maintenance\MaintenanceExecution;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExecutionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public MaintenanceExecution $execution)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ejecucion de mantenimiento')
            ->greeting(__("Hola :created",['created' => $notifiable->name]))
            ->line(__('Se le informa que el usuario, :user ha ejecutado el mantenimiento # :maintenance', ['user' => $this->execution->user->name, 'maintenance' => $this->execution->maintenance->id]))
            ->action('Ver mantenimiento', route('maintenances.index',['idd' => $this->execution->maintenance->id]))
            ->line('¡Notificaciones siteb!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => __('Se le informa que el usuario, :user ha ejecutado el mantenimiento # :maintenance', ['user' => $this->execution->user->name, 'maintenance' => $this->execution->maintenance->id]),
            'route_name' => 'maintenances.index',
            'model_id' => $this->execution->maintenance->id,
            'icon' => 'ki-check',
            'class' => 'text-success',

        ];
    }

    
}
