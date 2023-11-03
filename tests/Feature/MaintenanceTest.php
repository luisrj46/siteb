<?php

namespace Tests\Feature;

use App\Models\Maintenance\Maintenance;
use App\Models\Maintenance\MaintenanceExecution;
use App\Models\User\User;
use Illuminate\Support\Arr;
use Tests\TestCase;

class MaintenanceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list_maintenance(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('maintenances.index'));
        $response->assertOk();
    }
    /**
     * A basic feature test example.
     */
    public function test_dataTable_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('maintenances.index'));

        $response->assertOk()
        ->assertSee('#', 'Nombre', 'Marca', 'Acciones');
    }
    /**
     * A basic feature test example.
     */
    public function test_view_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.show', [$maintenance,'action' => 'view', 'modelTitle' => 'Mantenimiento']));

        $response->assertOk();
        $response->assertSee($maintenance->name);
    }

    public function test_edit_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.edit', [$maintenance,'action' => 'edit', 'modelTitle' => 'Mantenimiento']));

        $response->assertOk();
        $response->assertSee($maintenance->name);
    }


    public function test_create_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('maintenances.create', ['action' => 'create', 'modelTitle' => 'Mantenimiento']));

        $response->assertOk();
    }

    public function test_store_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $maintenance = Maintenance::factory()->create();

        $values = $maintenance->toArray();
        Arr::forget($values, ['created_by']);

        $response = $this->post(
            route('maintenances.store'),
            $values
        );

        $response->assertOk();
        $response->assertJsonFragment(["message" => 'Mantenimiento registrado correctamente']);
    }

    public function test_update_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $maintenance = Maintenance::factory()->create();

        $values = $maintenance->toArray();
        Arr::forget($values, ['created_by']);
        $new_name = 'New Test edit';
        $values['name'] = $new_name;
        $this->actingAs($user);

        $response = $this->post(
            route('maintenances.update', $maintenance),
            $values
        );
        $response->assertOk();
        $response->assertJsonFragment(["message" => 'Mantenimiento actualizado correctamente']);
    }

    public function test_delete_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.show', [$maintenance, 'action' => 'delete', 'modelTitle' => 'Mantenimiento']));

        $response->assertStatus(200);
        $response->assertSeeText($maintenance->name);
    }

    public function test_destroy_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);

        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->delete(route('maintenances.destroy', $maintenance));

        $response->assertOk()
            ->assertJsonFragment(["message" => 'Mantenimiento eliminado correctamente']);
    }

    public function test_execution_form_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.execution.form', [$maintenance, 'action' => 'execution', 'modelTitle' => 'Mantenimiento']));

        $response->assertStatus(200);
        $response->assertSeeText($maintenance->name);
        $response->assertSeeText("Ejecutar Mantenimiento");
    }

    public function test_execution_maintenance(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $maintenance = Maintenance::factory()->create();

        $values = $maintenance->toArray();
        Arr::forget($values, ['created_by']);
        $execution = MaintenanceExecution::factory()->make()->toArray();
        $result = array_merge($values, $execution);
        $new_name = 'New Test edit';
        $values['name'] = $new_name;
        $this->actingAs($user);

        $response = $this->post(
            route('maintenances.execution', $maintenance),
            $result
        );
        $response->assertOk();
        $response->assertJsonFragment(["message" => 'Mantenimiento ejecutado correctamente']);
    }
}
