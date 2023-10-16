<?php

namespace Database\Seeders\User;

use App\Models\User\User;
use Database\Seeders\Roles\RolesSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(20)
        ->create();

        foreach ($users as $user) {
            $user->assignRole(Role::whereNotIn('name', [RolesSeeder::ROOT])->get()->random());
        }

    }
}
