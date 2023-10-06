<?php

namespace Database\Seeders;

use Database\Seeders\CountryCity\CitySeeder;
use Database\Seeders\CountryCity\CountrySeeder;
use Database\Seeders\CountryCity\StateSeeder;
use Database\Seeders\GracePeriod\GracePeriodSeeder;
use Database\Seeders\Phone\PhoneTypeSeeder;
use Database\Seeders\Roles\PermissionsSeeder;
use Database\Seeders\Roles\RoleHasPermissionSeeder;
use Database\Seeders\Roles\RolesSeeder;
use Database\Seeders\Setting\GeneralSettingSeeder;
use Database\Seeders\User\TypeDocumentSeeder;
use Database\Seeders\User\TypeUserSeeder;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\Property\PropertySeeder;
use Database\Seeders\Amenity\AmenitySeeder;
use Database\Seeders\Bank\AccountTypeSeeder;
use Database\Seeders\Promotion\PromotionSeeder;
use Database\Seeders\Property\CategoryPropertySeeder;
use Database\Seeders\Property\RoomTypeSeeder;
use Database\Seeders\Property\TypeRestrictionSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            RoleHasPermissionSeeder::class,
        ]);
    }
}
