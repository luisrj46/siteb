<?php

namespace Database\Factories\BiomedicalEquipment;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BiomedicalEquipment\MaintenanceItem>
 */
class MaintenanceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->address(),
            'id' => null
        ];
    }
}
