<?php

namespace Database\Seeders\Roles;

use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));

        $coordinatorRole = Role::whereName(RolesSeeder::COORDINATOR)->first();
        $coordinatorPermission = Permission::whereIn('name', [
                'user.index',
                'user.show',
                'user.store',
                'user.update',
                'user.destroy',
                'biomedical.equipment.index',
                'biomedical.equipment.show',
                'biomedical.equipment.store',
                'biomedical.equipment.update',
                'biomedical.equipment.destroy',
                'biomedical.equipment.disable',
                'maintenance.index',
                'maintenance.show',
                'maintenance.store',
                'maintenance.update',
                'maintenance.destroy',
            ])->get()->pluck('id');

        $coordinatorRole->permissions()->sync($coordinatorPermission);

        $secretaryRole = Role::whereName(RolesSeeder::SECRETARY)->first();
        $secretaryPermission = Permission::whereIn('name', [
                'user.index',
                'user.show',
                'biomedical.equipment.index',
                'biomedical.equipment.show',
                'biomedical.equipment.store',
                'biomedical.equipment.update',
                'maintenance.index',
                'maintenance.show',
                'maintenance.store',
                'maintenance.update',
            ])->get()->pluck('id');

        $secretaryRole->permissions()->sync($secretaryPermission);

        $supportRole = Role::whereName(RolesSeeder::SUPPORT)->first();
        $supportPermission = Permission::whereIn('name', [
                'biomedical.equipment.index',
                'biomedical.equipment.show',
                'maintenance.index',
                'maintenance.show',
                'maintenance.execution',
            ])->get()->pluck('id');

        $supportRole->permissions()->sync($supportPermission);


        foreach (User::all() ?? [] as $user) {
            $user->roles()->sync([Role::where('name', '!=', RolesSeeder::ROOT)->get()->random()->id]);
        }
        
        $rootRole = Role::whereName(RolesSeeder::ROOT)->first();
        $UserRoot = User::first();
        $UserRoot->roles()->sync([$rootRole->id]);
    }
}
