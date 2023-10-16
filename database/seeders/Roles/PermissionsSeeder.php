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

                ['name' => 'biomedical.equipment.index', 'title' => 'Listar', 'group_name' => 'Equipo biomédico'],
                ['name' => 'biomedical.equipment.show', 'title' => 'Ver','group_name' => 'Equipo biomédico'],
                ['name' => 'biomedical.equipment.store', 'title' => 'Registrar','group_name' => 'Equipo biomédico'],
                ['name' => 'biomedical.equipment.update', 'title' => 'Actualizar','group_name' => 'Equipo biomédico'],
                ['name' => 'biomedical.equipment.destroy', 'title' => 'Eliminar','group_name' => 'Equipo biomédico'],
                ['name' => 'biomedical.equipment.disable', 'title' => 'Deshabilitar','group_name' => 'Equipo biomédico'],
                
                ['name' => 'maintenance.index', 'title' => 'Listar', 'group_name' => 'Mantenimiento'],
                ['name' => 'maintenance.show', 'title' => 'Ver','group_name' => 'Mantenimiento'],
                ['name' => 'maintenance.store', 'title' => 'Registrar','group_name' => 'Mantenimiento'],
                ['name' => 'maintenance.update', 'title' => 'Actualizar','group_name' => 'Mantenimiento'],
                ['name' => 'maintenance.destroy', 'title' => 'Eliminar','group_name' => 'Mantenimiento'],
                
                ['name' => 'maintenance.execution', 'title' => 'Ejecutar','group_name' => 'Mantenimiento'],

            ],
            ['name'],
            ['title','group_name']
        );
    }
}
