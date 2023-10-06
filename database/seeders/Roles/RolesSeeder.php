<?php

namespace Database\Seeders\Roles;

use App\Models\User\TypeUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    use WithoutModelEvents;

    const ROOT = 'root';
    const COORDINATOR = 'coordinator';
    const SUPPORT = 'support';
    const SECRETARY = 'secretary';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::upsert(
            [
                ['id' => 1, 'name' => self::ROOT, 'title' => 'Super administrador'],
                ['id' => 2, 'name' => self::COORDINATOR, 'title' => 'Coodinador'],
                ['id' => 3, 'name' => self::SUPPORT, 'title' => 'Ingeniero de soporte'],
                ['id' => 4, 'name' => self::SECRETARY, 'title' => 'Secretario'],
            ],
            ['id'],
            ['name','title']
        );
    }
}
