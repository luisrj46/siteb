<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiomedicalEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BiomedicalEquipment::factory()
            ->count(20)
            ->hasMaintenanceItems(3)
            ->hasComponents(5)
            ->create();
    }
}
