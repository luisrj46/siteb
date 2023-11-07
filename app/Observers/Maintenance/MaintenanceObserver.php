<?php

namespace App\Observers\Maintenance;

use App\Models\Maintenance\Maintenance;
use App\Notifications\Maintenance\MaintenanceNotification;

class MaintenanceObserver
{
    /**
     * Handle the Maintenance "created" event.
     */
    public function created(Maintenance $maintenance): void
    {
        if($maintenance->maintenanceType->slug == $maintenance->maintenanceType::CORRECTIVE && now()->diffInHours($maintenance->scheduled_date) == 0){
            $maintenance->user?->notify( new MaintenanceNotification($maintenance));
        }
    }

    /**
     * Handle the Maintenance "updated" event.
     */
    public function updated(Maintenance $maintenance): void
    {
        //
    }

    /**
     * Handle the Maintenance "deleted" event.
     */
    public function deleted(Maintenance $maintenance): void
    {
        //
    }

    /**
     * Handle the Maintenance "restored" event.
     */
    public function restored(Maintenance $maintenance): void
    {
        //
    }

    /**
     * Handle the Maintenance "force deleted" event.
     */
    public function forceDeleted(Maintenance $maintenance): void
    {
        //
    }
}
