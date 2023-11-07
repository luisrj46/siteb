<?php

namespace Database\Factories\Maintenance;

use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\Maintenance\MaintenanceType;
use App\Models\User\User;
use Database\Seeders\Roles\RolesSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maintenance_type_id' => MaintenanceType::get()->random(),
            'biomedical_equipment_id' => BiomedicalEquipment::get()->random(),
            'user_id' => User::role(RolesSeeder::SUPPORT)->get()->random(),
            'observation' => $this->faker->paragraph,
            'scheduled_date' => now()->addDays(rand(1, 15))->addHours(rand(0, 20))->format('Y-m-d H:i:s'),
            'created_by' => User::get()->random(),
        ];
    }
}
