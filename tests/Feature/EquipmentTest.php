<?php

namespace Tests\Feature;

use App\Models\BiomedicalEquipment\BiomedicalClassification;
use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\BiomedicalEquipment\Period;
use App\Models\BiomedicalEquipment\Plan;
use App\Models\BiomedicalEquipment\RiskClass;
use App\Models\BiomedicalEquipment\UseBiomedical;
use App\Models\BiomedicalEquipment\YesOrNot;
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
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.index'));
        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     */
    public function test_dataTable_equipment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.index'));
        
        $response->assertStatus(200);
        
    }
    /**
     * A basic feature test example.
     */
    public function test_view_equipment(): void
    {
        $user = User::factory()->create();
        $equipment = BiomedicalEquipment::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.show',$equipment));
        
        $response->assertStatus(200);
        $response->assertSee($equipment->name);
        
    }
    
    public function test_edit_equipment(): void
    {
        $user = User::factory()->create();
        $equipment = BiomedicalEquipment::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.edit',$equipment));
        
        $response->assertStatus(200);
        $response->assertSee($equipment->name);
        
    }


    public function test_create_equipment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.create'));
        
        $response->assertStatus(200);
        
    }

    public function test_store_equipment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post(route('biomedicalEquipments.store'),[
            'name' => fake()->firstName,
            'brand' => fake()->creditCardType,
            'model' => fake()->rgbColor,
            'series' => fake()->streetName,
            'active_code' => fake()->numerify(),
            'service' => fake()->company,
            'ambient' => fake()->word,
            'invima_register' => fake()->numberBetween(1000,50000),
            'cost' => fake()->numberBetween(10000000,50000000),
            'property' => ['Propio','Alquilado'][array_rand(['Propio','Alquilado'])],
            'form_acquisition' => ['Comprado','Credito'][array_rand(['Comprado','Credito'])],
            'date_purchase' => fake()->date(),
            'reception_condition' => fake()->titleFemale,
            'year_production' => fake()->year,
            'maker' => fake()->company,
            'manufacturer_phone' => fake()->e164PhoneNumber,
            'representative' => fake()->titleMale,
            'representative_phone' => fake()->e164PhoneNumber,
            'periodicity_preventive' => Period::get()->random()->id,
            'requires_calibration' => YesOrNot::get()->random()->id,
            'calibration_periodicity' => Period::get()->random()->id,
            'operation_manual' => YesOrNot::get()->random()->id,
            'maintenance_manual' => YesOrNot::get()->random()->id,
            'plans' => Plan::get()->random()->id,
            'uses' => UseBiomedical::get()->random()->id,
            'biomedical_classification' => BiomedicalClassification::get()->random()->id,
            'risk_class' => RiskClass::get()->random()->id,
            'power_supply' => fake()->jobTitle,
            'frequency' => fake()->numberBetween(100,400).' Hz',
            'weight' => fake()->numberBetween(100,1150).' Kg',
            'temperature' => fake()->numberBetween(10,40). ' °C',
            'voltage' => [115,220][array_rand([115,220])].' AC',
            'description' => fake()->paragraph(1),
            'damaged' => YesOrNot::get()->random()->id,
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment(["message" => 'Equipo biomédico registrado correctamente']);
    }
    
    public function test_update_equipment(): void
    {
        $user = User::factory()->create();
        $equipment = BiomedicalEquipment::factory()->create();
        $prefix = 'New Test';
        $this->actingAs($user);
        
        $response = $this->post(route('biomedicalEquipments.update',$equipment),
        [
            'name' => $prefix.fake()->firstName,
            'brand' => $prefix.fake()->creditCardType,
            'model' => $prefix.fake()->rgbColor,
            'series' => $prefix.fake()->streetName,
            'active_code' => $prefix.fake()->numerify(),
            'service' => $prefix.fake()->company,
            'ambient' => $prefix.fake()->word,
            'requires_calibration' => YesOrNot::get()->random()->id,
            'calibration_periodicity' => Period::get()->random()->id,
            'operation_manual' => YesOrNot::get()->random()->id,
            'maintenance_manual' => YesOrNot::get()->random()->id,
            'plans' => Plan::get()->random()->id,
            'uses' => UseBiomedical::get()->random()->id,
            
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment(["message" => 'Equipo biomédico actualizado correctamente']);
    }

    public function test_delete_equipment(): void
    {
        $user = User::factory()->create();
        $equipment = BiomedicalEquipment::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('biomedicalEquipments.delete',$equipment));
        
        $response->assertStatus(200);
        $response->assertSee($equipment->name);
        
    }

    public function test_destroy_equipment(): void
    {
        $user = User::factory()->create();
        $equipment = BiomedicalEquipment::factory()->create();
        $this->actingAs($user);
        $response = $this->delete(route('biomedicalEquipments.destroy',$equipment));
        
        $response->assertStatus(200);
        
    }

}
