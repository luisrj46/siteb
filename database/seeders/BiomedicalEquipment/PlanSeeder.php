<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['name' => 'Mecánicos', 'slug' => Plan::MECHANICS],
            ['name' => 'Electrónica', 'slug' => Plan::ELECTRONICS],
            ['name' => 'Hidráulicos', 'slug' => Plan::HYDRAULIC],
            ['name' => 'Neumáticos', 'slug' => Plan::TIRES],
        ];


        Plan::upsert(
            $plans,
            ['slug'],
            ['name']
        );
    }
}
