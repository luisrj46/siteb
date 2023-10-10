<?php

namespace Database\Seeders\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\UseBiomedical;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UseBiomedicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UseBiomedical::upsert(
            [
                ['slug' => UseBiomedical::MEDICAL, 'name' => 'Medico'],
                ['slug' => UseBiomedical::BASIC, 'name' => 'Basico'],
                ['slug' => UseBiomedical::SUPPORT, 'name' => 'Apoyo'],
                ['slug' => UseBiomedical::TRANSPORT, 'name' => 'Medio de transporte'],
            ],
            ['slug'],
            ['name'],
        );
    }
}
