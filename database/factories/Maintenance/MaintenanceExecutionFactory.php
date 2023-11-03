<?php

namespace Database\Factories\Maintenance;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance\MaintenanceExecution>
 */
class MaintenanceExecutionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'execution_id' => null,
            'execution_start_date' => now()->format('Y-m-d H:i:s'),
            'execution_end_date' => now()->addHours(2)->format('Y-m-d H:i:s'),
            'execution_materials' => $this->faker->paragraph(2),
            'execution_observation' => $this->faker->paragraph(4),
            'photo' => UploadedFile::fake()->image('photo2.jpg'),
        ];
    }
}
