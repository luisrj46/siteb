<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\RiskClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiskClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RiskClass::upsert(
            [
                ['name' => 'I', 'slug'=> RiskClass::I],
                ['name' => 'IIA', 'slug'=> RiskClass::IIA],
                ['name' => 'IIB', 'slug'=> RiskClass::IIB],
                ['name' => 'III', 'slug'=> RiskClass::III],
            ],
            ['slug'],
            ['name'],
        );
    }
}
