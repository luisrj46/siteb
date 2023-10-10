<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\YesOrNot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YesOrNotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        YesOrNot::upsert(
            [
                ['slug' => YesOrNot::YES, 'name' => 'Si'],
                ['slug' => YesOrNot::NOT, 'name' => 'No'],
            ],
            ['slug'],
            ['name'],
        );
    }
}
