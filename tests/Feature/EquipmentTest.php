<?php

namespace Tests\Feature;

use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EquipmentTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /**
     * A basic feature test example.
     */
    public function test_list_equipment(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.index'));
        $response->assertOk();
    }
    /**
     * A basic feature test example.
     */
    public function test_dataTable_equipment(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.index'));

        $response->assertOk()
        ->assertSeeText('#', 'Nombre', 'Marca', 'Acciones');
    }
    /**
     * A basic feature test example.
     */
    public function test_view_equipment(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $equipment = BiomedicalEquipment::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.show', [$equipment,'action' => 'view', 'modelTitle' => 'Equipo biomédico']));

        $response->assertOk();
        $response->assertSee($equipment->name);
    }

    public function test_edit_equipment(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $equipment = BiomedicalEquipment::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.edit', [$equipment,'action' => 'edit', 'modelTitle' => 'Equipo biomédico']));

        $response->assertOk();
        $response->assertSee($equipment->name);
    }


    public function test_create_equipment(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.create', ['action' => 'create', 'modelTitle' => 'Equipo biomédico']));

        $response->assertOk();
    }

    public function test_store_equipment(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $this->actingAs($user);
        $equipment = BiomedicalEquipment::factory()->make();

        $values = $equipment->toArray();
        $values['items'] = \App\Models\BiomedicalEquipment\MaintenanceItem::factory(3)->make()->toArray();
        $values['components'] = \App\Models\BiomedicalEquipment\Component::factory(2)->make()->toArray();

        $response = $this->post(
            route('biomedicalEquipments.store'),
            $values
        );

        $response->assertOk();
        $response->assertJsonFragment(["message" => 'Equipo biomédico registrado correctamente']);
    }

    public function test_update_equipment(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $equipment = BiomedicalEquipment::factory()->create();

        $values = $equipment->toArray();
        $new_name = 'New Test edit';
        $values['name'] = $new_name;
        $this->actingAs($user);

        $response = $this->post(
            route('biomedicalEquipments.update', $equipment),
            $values
        );
        $response->assertOk();
        $response->assertJsonFragment(["message" => 'Equipo biomédico actualizado correctamente']);
    }

    public function test_delete_equipment(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);
        $equipment = BiomedicalEquipment::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.show', [$equipment, 'action' => 'delete', 'modelTitle' => 'Equipo biomédico']));

        $response->assertStatus(200);
        $response->assertSeeText($equipment->name);
    }

    public function test_destroy_equipment(): void
    {
        $user = User::factory()->create();
        $user->assignRole([1]);

        $equipment = BiomedicalEquipment::factory()->create();
        $this->actingAs($user);
        $response = $this->delete(route('biomedicalEquipments.destroy', $equipment));

        $response->assertOk()
            ->assertJsonFragment(["message" => 'Equipo biomédico eliminado correctamente']);
    }
}
