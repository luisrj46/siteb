<?php
namespace App\Models\LabsMobile;

interface LabsMobileNotificationInterface {
    /** @return \App\Models\LabsMobile\Message */
    public function toSMS($notifiable);
}