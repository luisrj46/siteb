<?php

namespace Tests\Feature;

use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\Maintenance\Maintenance;
use App\Models\Maintenance\MaintenanceType;
use App\Models\User\User;
use Tests\TestCase;

class MaintenanceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /**
     * A basic feature test example.
     */
    public function test_list_maintenance(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.index'));
        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     */
    public function test_dataTable_maintenance(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.index'));
        
        $response->assertStatus(200);
        
    }
    /**
     * A basic feature test example.
     */
    public function test_view_maintenance(): void
    {
        $user = User::factory()->create();
        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.show',$maintenance));
        
        $response->assertStatus(200);
        $response->assertSee($maintenance->name);
        
    }
    
    public function test_edit_maintenance(): void
    {
        $user = User::factory()->create();
        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.edit',$maintenance));
        
        $response->assertStatus(200);
        $response->assertSee($maintenance->name);
        
    }


    public function test_update_maintenance(): void
    {
        $user = User::factory()->create();
        $maintenance = Maintenance::factory()->create();
        $prefix = 'New Test Update ';
        $this->actingAs($user);

        $response = $this->post(route('maintenances.update',$maintenance),
        [
            'start_datetime' => fake()->date('Y-m-d H:i:s'),
            'end_datetime' => fake()->date('Y-m-d H:i:s'),
            'materials' => $prefix.fake()->paragraph(2),
            'responsible' => User::get()->random()->id ?? null,
            
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment(["message" => 'Mantenimiento actualizado correctamente']);
    }

    public function test_create_equipment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.create'));
        
        $response->assertStatus(200);
        
    }

    public function test_store_maintenance(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post(route('maintenances.store'),[
            'biomedical_equipment_id' => BiomedicalEquipment::get()->random()->id,
            'maintenance_type_id' => MaintenanceType::get()->random()->id,
            'responsible' => User::get()->random()->id ?? null,
            'start_datetime' => fake()->date('Y-m-d H:i:s'),
            'end_datetime' => fake()->date('Y-m-d H:i:s'),
            'materials' => fake()->paragraph(2),
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment(["message" => 'Mantenimiento registrado correctamente']);
    }
    

    public function test_delete_maintenance(): void
    {
        $user = User::factory()->create();
        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('maintenances.delete',$maintenance));
        
        $response->assertStatus(200);
        $response->assertSee($maintenance->name);
        
    }

    public function test_destroy_maintenance(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $maintenance = Maintenance::factory()->create();
        $this->actingAs($user);
        $response = $this->delete(route('maintenances.destroy',$maintenance));
        
        $response->assertStatus(200);
        
    }

}
