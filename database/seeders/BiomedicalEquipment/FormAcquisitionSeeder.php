<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\FormAcquisition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormAcquisitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormAcquisition::upsert(
            [
                ['name' => 'Comprado', 'slug'=> FormAcquisition::PURCHASED],
                ['name' => 'Credito', 'slug'=> FormAcquisition::CREDIT],
            ],
            ['slug'],
            ['name'],
        );
    }
}