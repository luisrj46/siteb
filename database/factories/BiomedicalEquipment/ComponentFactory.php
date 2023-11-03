<?php

namespace Database\Factories\BiomedicalEquipment;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BiomedicalEquipment\Component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => null,
            'name' => fake()->name(),
            'brand' => substr(fake()->imei(),0,5),
            'model' => fake()->linuxProcessor(),
            'serie' => fake()->swiftBicNumber(),
        ];
    }
}
