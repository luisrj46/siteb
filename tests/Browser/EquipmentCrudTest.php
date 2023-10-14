<?php

namespace Tests\Browser;

use App\Models\BiomedicalClassification;
use App\Models\BiomedicalEquipment;
use App\Models\Period;
use App\Models\Plans;
use App\Models\RiskClass;
use App\Models\UseBiomedical;
use App\Models\User;
use App\Models\YesOrNot;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EquipmentCrudTest extends DuskTestCase
{
    public function testListarEquipos(): void
    {
        $user = User::factory()->create();
        $equipment = BiomedicalEquipment::factory()->create();
        $this->browse(function (Browser $browser) use ($user,$equipment) {
            $browser->loginAs($user)
                    ->visit(route('biomedicalEquipments.index'))
                    ->waitFor('table.biomedical_equipments')
                    ->with('table.biomedical_equipments', function (Browser $table) use ($equipment) {
                        $table->assertSee($equipment->name);
                    })
                    ->assertSee('Listado de equipos biomédicos');
        });
    }


    public function testCreateEquipos(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $prefix = 'Test dusk ';
            $newName = $prefix.fake()->firstName;
            $browser->loginAs($user)
                    ->visit(route('biomedicalEquipments.index'))
                    ->clickLink('Registrar')
                    ->whenAvailable('.modal', function (Browser $modal) use($newName, $prefix) {
                        $modal->assertSee('Crear equipo biomédico')
                            ->value('#name', $newName)
                            ->value('#brand', fake()->creditCardType)
                            ->value('#model', fake()->rgbColor)
                            ->value('#series', fake()->streetName)
                            ->value('#active_code', fake()->numerify())
                            ->value('#service', fake()->company)
                            ->value('#ambient', fake()->word)
                            ->value('#invima_register', fake()->numberBetween(1000,50000))
                            ->value('#cost', fake()->numberBetween(10000000,50000000))
                            ->value('#property', ['Propio','Alquilado'][array_rand(['Propio','Alquilado'])])
                            ->value('#form_acquisition', ['Comprado','Credito'][array_rand(['Comprado','Credito'])])
                            ->value('#date_purchase', fake()->date())
                            ->value('#reception_condition', fake()->titleFemale)
                            ->value('#year_production', fake()->year)
                            ->value('#maker', fake()->company)
                            ->value('#manufacturer_phone', fake()->e164PhoneNumber)
                            ->value('#representative', fake()->titleMale)
                            ->value('#representative_phone', fake()->e164PhoneNumber)
                            ->select('#periodicity_preventive', Period::get()->random()->id)
                            ->select('#requires_calibration', YesOrNot::get()->random()->id)
                            ->select('#calibration_periodicity', Period::get()->random()->id)
                            ->select('#operation_manual', YesOrNot::get()->random()->id)
                            ->select('#maintenance_manual', YesOrNot::get()->random()->id)
                            ->select('#plans', Plans::get()->random()->id)
                            ->select('#uses', UseBiomedical::get()->random()->id)
                            ->select('#biomedical_classification', BiomedicalClassification::get()->random()->id)
                            ->select('#risk_class', RiskClass::get()->random()->id)
                            ->value('#power_supply', fake()->jobTitle)
                            ->value('#frequency', fake()->numberBetween(100,400).' Hz')
                            ->value('#weight', fake()->numberBetween(100,1150).' Kg')
                            ->value('#temperature', fake()->numberBetween(10,40). ' °C')
                            ->value('#voltage', [115,220][array_rand([115,220])].' AC')
                            ->value('#description', fake()->paragraph(1))
                            ->click('.addItems')
                            ->click('.addItems')
                            ->click('.addItems')
                            ->value('[name="items[-3]"]', $prefix.fake()->address())
                            ->value('[name="items[-2]"]', $prefix.fake()->address())
                            ->value('[name="items[-1]"]', $prefix.fake()->address())
                            ->click('.addComponent')
                            ->click('.addComponent')
                            ->value('[name="component[name][-1]"]', $prefix.fake()->name())
                            ->value('[name="component[brand][-1]"]', $prefix.substr(fake()->imei(),0,5))
                            ->value('[name="component[model][-1]"]', $prefix.fake()->linuxProcessor())
                            ->value('[name="component[serie][-1]"]', $prefix.fake()->swiftBicNumber())
                            ->value('[name="component[name][-2]"]', $prefix.fake()->name())
                            ->value('[name="component[brand][-2]"]', $prefix.substr(fake()->imei(),0,5))
                            ->value('[name="component[model][-2]"]', $prefix.fake()->linuxProcessor())
                            ->value('[name="component[serie][-2]"]', $prefix.fake()->swiftBicNumber())
                            ->press('Guardar');
                    })
                    ->waitFor('table.biomedical_equipments',15)
                    ->assertSee($newName)
                    ->assertSee('Equipo biomédico registrado correctamente');

        });
    }


    public function testUpdateEquipos(): void
    {
        $user = User::factory()->create();
        
        $this->browse(function (Browser $browser) use ($user) {
            $prefix = "Name edit dusk - ";
            $nameNew = $prefix.fake()->firstName;
            $browser->loginAs($user)
                    ->visit(route('biomedicalEquipments.index'))
                    ->waitFor('table.biomedical_equipments')
                    ->with('table.biomedical_equipments', function (Browser $table) {
                        $table->click('a.edit');
                    })
                    ->whenAvailable('.modal', function (Browser $modal) use($nameNew) {
                        $modal->assertSee('Editar equipo biomédico')
                        ->value('#name', $nameNew)
                        ->press('Guardar');
                    })
                    ->waitFor('table.biomedical_equipments', 15)
                    ->assertSee($nameNew)
                    ->assertSee('Equipo biomédico actualizado correctamente');

        });
    }

    public function testViewEquipos(): void
    {
        $user = User::factory()->create();
        $equipment = BiomedicalEquipment::factory()->create();

        $this->browse(function (Browser $browser) use ($user,$equipment) {
            $browser->loginAs($user)
                    ->visit(route('biomedicalEquipments.index'))
                    ->waitFor('table.biomedical_equipments')
                    ->with('table.biomedical_equipments', function (Browser $table) {
                        $table->click('a.view');
                    })
                    ->whenAvailable('.modal', function (Browser $modal) use($equipment) {
                        $modal->assertSee('Ver equipo biomédico')
                        ->assertValue('#name',$equipment->name)
                        ->press('Cerrar');
                    })
                    ->waitFor('table.biomedical_equipments')
                    ->assertSee('Listado de equipos biomédicos');

        });
    }

    public function testDeleteEquipos(): void
    {
        $user = User::factory()->create();
        $equipment = BiomedicalEquipment::factory()->create();
        
        $this->browse(function (Browser $browser) use ($user, $equipment) {
            $browser->loginAs($user)
                    ->visit(route('biomedicalEquipments.index'))
                    ->waitFor('table.biomedical_equipments')
                    ->with('table.biomedical_equipments', function (Browser $table) use($equipment) {
                        $table->click('a.delete');
                    })
                    ->whenAvailable('.modal', function (Browser $modal) use($equipment) {
                        $modal->assertSee('Eliminar equipo biomédico')
                        ->assertSee($equipment->name)
                        ->press('Eliminar');
                    })
                    ->waitFor('table.biomedical_equipments')
                    ->assertSee('Equipo biomédico eliminado correctamente');

        });
    }
}
