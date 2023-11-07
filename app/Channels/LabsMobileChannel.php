<?php
namespace App\Channels;

use Exception;
use Illuminate\Notifications\Notification;

class LabsMobileChannel {
    public function send ($notifiable, Notification $notification) {
        if (!method_exists($notification, 'toSMS')) {
            throw new Exception("No se configurado el método toSMS en la notificación");
        }

        /** @var \App\Models\LabsMobile\LabsMobileNotificationInterface $notification */
        $message = $notification->toSMS($notifiable);
        try {
            $result = $message->send();
        }catch (Exception $e) {
            throw new Exception("No se pudo enviar la notificación al LabsMobile: {$e->getMessage()}");
        }
        return $result;
    }
}