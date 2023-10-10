<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\BiomedicalClassification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiomedicalClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BiomedicalClassification::upsert(
            [
                ['slug' => BiomedicalClassification::DIAGNOSTIC, 'name' => 'Diagnóstico'],
                ['slug' => BiomedicalClassification::THERAPEUTIC, 'name' => 'Terapéutico'],
                ['slug' => BiomedicalClassification::ANALYTICAL, 'name' => 'Analítica'],
                ['slug' => BiomedicalClassification::OTHER, 'name' => 'Otros'],
            ],
            ['slug'],
            ['name'],
        );
    }
}
