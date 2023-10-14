<?php

namespace Database\Seeders;

use Database\Seeders\BiomedicalEquipment\BiomedicalClassificationSeeder;
use Database\Seeders\BiomedicalEquipment\BiomedicalEquipmentSeeder;
use Database\Seeders\BiomedicalEquipment\FormAcquisitionSeeder;
use Database\Seeders\BiomedicalEquipment\PeriodSeeder;
use Database\Seeders\BiomedicalEquipment\PlanSeeder;
use Database\Seeders\BiomedicalEquipment\PropertySeeder;
use Database\Seeders\BiomedicalEquipment\RiskClassSeeder;
use Database\Seeders\BiomedicalEquipment\ServiceSeeder;
use Database\Seeders\BiomedicalEquipment\UseBiomedicalSeeder;
use Database\Seeders\BiomedicalEquipment\YesOrNotSeeder;
use Database\Seeders\Roles\PermissionsSeeder;
use Database\Seeders\Roles\RoleHasPermissionSeeder;
use Database\Seeders\Roles\RolesSeeder;
use Database\Seeders\User\UserSeeder;
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
            BiomedicalClassificationSeeder::class,
            FormAcquisitionSeeder::class,
            PeriodSeeder::class,
            PlanSeeder::class,
            PropertySeeder::class,
            RiskClassSeeder::class,
            UseBiomedicalSeeder::class,
            YesOrNotSeeder::class,
            ServiceSeeder::class,
            BiomedicalEquipmentSeeder::class,

        ]);
    }
}
