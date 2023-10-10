<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\Period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Period::upsert(
            [
                ['slug' => Period::TRIMESTER, 'name' => 'Trimestral','months' => 3],
                ['slug' => Period::QUARTERLY, 'name' => 'Cuatrimestral','months' => 4],
                ['slug' => Period::BIANNUAL, 'name' => 'Semestral','months' => 6],
                ['slug' => Period::ANNUAL, 'name' => 'Anual','months' => 12],
            ],
            ['slug'],
            ['months','name']
        );
    }
}
