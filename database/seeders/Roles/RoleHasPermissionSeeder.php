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
            
        $adminRole = Role::whereName(RolesSeeder::COORDINATOR)->first();
        $adminPermission = Permission::get()->pluck('id');
        
        $adminRole->permissions()->sync($adminPermission);



        $rootRole = Role::whereName(RolesSeeder::ROOT)->first();
        $UserRoot = User::first();
        $UserRoot->roles()->sync([$rootRole->id]);
    }
}
