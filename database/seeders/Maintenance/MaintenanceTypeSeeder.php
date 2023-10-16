<?php

namespace Database\Seeders\Maintenance;

use App\Models\Maintenance\MaintenanceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaintenanceType::upsert(
            [
                [
                    'name' => 'Preventivo',
                    'slug' => MaintenanceType::PREVENTIVE,
                ],
                [
                    'name' => 'Correctivo',
                    'slug' => MaintenanceType::CORRECTIVE,
                ],
            ],
            ['slug'],
            ['name']
        );
    }
}
