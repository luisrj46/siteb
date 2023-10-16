<?php

namespace Database\Seeders\Maintenance;

use App\Models\Maintenance\Maintenance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Maintenance::factory(20)->create();
    }
}
