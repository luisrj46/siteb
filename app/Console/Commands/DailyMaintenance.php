<?php

namespace App\Console\Commands;

use App\Models\Maintenance\Maintenance;
use App\Models\Maintenance\MaintenanceType;
use App\Notifications\Maintenance\MaintenanceNotification;
use Illuminate\Console\Command;

class DailyMaintenance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-maintenance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $maintenances = Maintenance::doesntHave('maintenanceExecution')->whereDate('scheduled_date', now())->whereDate('created_at', '<=', now()->format('Y-m-d 07:00:00'))->get();
        foreach ($maintenances as $maintenance) {
            $maintenance->user?->notify( new MaintenanceNotification($maintenance));
        }
    }
}
