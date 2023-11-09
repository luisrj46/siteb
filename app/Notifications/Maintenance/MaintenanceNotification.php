<?php

namespace App\Notifications\Maintenance;

use App\Models\Maintenance\Maintenance;
use App\Models\LabsMobile\Message as LabsMobileMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaintenanceNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Maintenance $maintenance)
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
        return ['mail', 'database', \App\Channels\LabsMobileChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Programación de mantenimiento')
            ->line(__('Debe ejecutar el mantenimiento :type # :number programado para la fecha :date, para el equipo biomédico :equipment', ['type' => $this->maintenance->maintenanceType->name, 'number' => $this->maintenance->id, 'date' => $this->maintenance->scheduled_date, 'equipment' => $this->maintenance->biomedicalEquipment->name]))
            ->action('Ejecutar mantenimiento', route('maintenances.index',['idd' => $this->maintenance->id]))
            ->line('¡Recuerda gestionar a tiempo el mantenimiento!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => __('Debe ejecutar el mantenimiento :type, # :number programado para la fecha :date', ['number' => $this->maintenance->id, 'date' => $this->maintenance->scheduled_date, 'type' => $this->maintenance->maintenanceType->name]),
            'route' => route('maintenances.index',['idd' => $this->maintenance->id]),
            'maintenanceId' => $this->maintenance->id,
            'icon' => $this->maintenance->maintenanceType->slug == $this->maintenance->maintenanceType::PREVENTIVE ? 'questionnaire-tablet' : 'wrench',
            'class' => $this->maintenance->maintenanceType->slug == $this->maintenance->maintenanceType::PREVENTIVE ? 'text-warning' : 'text-danger',

        ];
    }

    public function toSMS($notifiable) {
        return (new LabsMobileMessage())
            ->to($notifiable->phone_sms)
            ->body( __('Ejecutar el mantenimiento :type, # :number para la fecha :date', ['number' => $this->maintenance->id, 'date' => $this->maintenance->scheduled_date, 'type' => strtolower($this->maintenance->maintenanceType->name)]));
    }
    
}
