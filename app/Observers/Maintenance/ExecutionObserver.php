<?php

namespace App\Observers\Maintenance;

use App\Models\Maintenance\MaintenanceExecution;
use App\Models\User\User;
use App\Notifications\Maintenance\ExecutionNotification;

class ExecutionObserver
{
    /**
     * Handle the MaintenanceExecution "created" event.
     */
    public function created(MaintenanceExecution $maintenanceExecution): void
    {
        $user = $maintenanceExecution->maintenance->createdBy;
        if($user instanceof User) $user->notify(new ExecutionNotification($maintenanceExecution));
    }

    /**
     * Handle the MaintenanceExecution "updated" event.
     */
    public function updated(MaintenanceExecution $maintenanceExecution): void
    {
        //
    }

    /**
     * Handle the MaintenanceExecution "deleted" event.
     */
    public function deleted(MaintenanceExecution $maintenanceExecution): void
    {
        //
    }

    /**
     * Handle the MaintenanceExecution "restored" event.
     */
    public function restored(MaintenanceExecution $maintenanceExecution): void
    {
        //
    }

    /**
     * Handle the MaintenanceExecution "force deleted" event.
     */
    public function forceDeleted(MaintenanceExecution $maintenanceExecution): void
    {
        //
    }
}
