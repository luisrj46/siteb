<?php

namespace Database\Seeders\User;

use App\Models\User\TypeUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeUserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeUser::upsert(
            [
                ['id' => TypeUser::CUSTOMER, 'name' => 'Cliente', 'slug' => TypeUser::CUSTOMER],
                ['id' => TypeUser::OWNER, 'name' => 'Propietario', 'slug' => TypeUser::OWNER],
                ['id' => TypeUser::ADMIN, 'name' => 'Administrador', 'slug' => TypeUser::ADMIN],
            ],
            ['id'],
            ['name', 'slug'],
        );
    }
}
