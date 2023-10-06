<?php

namespace Database\Seeders\User;

use App\Models\User\TypeDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeDocumentSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeDocument::upsert(
            [
                ['name' => 'Cedula ciudadania, Documento identidad','slug' => 1,'abbreviation' => 'C.C, DNI'],
                ['name' => 'Nit','slug' => 2,'abbreviation' => 'NIT'],
            ],
            ['slug'],
            ['name','abbreviation']
        );
    }
}
