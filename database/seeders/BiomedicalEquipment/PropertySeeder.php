<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::upsert(
            [
                ['name' => 'Propio', 'slug'=> Property::OWN],
                ['name' => 'Alquilado', 'slug'=> Property::RENTED],
            ],
            ['slug'],
            ['name'],
        );
    }
}
