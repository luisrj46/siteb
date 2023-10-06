<?php

namespace Database\Seeders\Roles;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::upsert(
            [
                ['name' => 'user.index', 'title' => 'Listar', 'group_name' => 'Usuario'],
                ['name' => 'user.show', 'title' => 'Ver','group_name' => 'Usuario'],
                ['name' => 'user.store', 'title' => 'Registrar','group_name' => 'Usuario'],
                ['name' => 'user.update', 'title' => 'Actualizar','group_name' => 'Usuario'],
                ['name' => 'user.destroy', 'title' => 'Eliminar','group_name' => 'Usuario'],

            ],
            ['name'],
            ['title','group_name']
        );
    }
}
