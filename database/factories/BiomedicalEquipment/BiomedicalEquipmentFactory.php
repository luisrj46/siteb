<?php

namespace Database\Factories\BiomedicalEquipment;

use App\Models\BiomedicalEquipment\BiomedicalClassification;
use App\Models\BiomedicalEquipment\FormAcquisition;
use App\Models\BiomedicalEquipment\Period;
use App\Models\BiomedicalEquipment\Plan;
use App\Models\BiomedicalEquipment\Property;
use App\Models\BiomedicalEquipment\RiskClass;
use App\Models\BiomedicalEquipment\UseBiomedical;
use App\Models\BiomedicalEquipment\Voltage;
use App\Models\BiomedicalEquipment\YesOrNot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BiomedicalEquipment\BiomedicalEquipment>
 */
class BiomedicalEquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName,
            'brand' => fake()->creditCardType,
            'model' => fake()->rgbColor,
            'series' => fake()->streetName,
            'active_code' => fake()->numerify(),
            'service' => fake()->company,
            'ambient' => fake()->word,
            'invima_register' => fake()->numberBetween(1000,50000),
            'cost' => fake()->numberBetween(10000000,50000000),
            'property_id' => Property::get()->random(),
            'form_acquisition_id' => FormAcquisition::get()->random(),
            'date_purchase' => fake()->date(),
            'reception_condition' => fake()->titleFemale,
            'year_production' => fake()->year,
            'maker' => fake()->company,
            'manufacturer_phone' => fake()->e164PhoneNumber,
            'representative' => fake()->titleMale,
            'representative_phone' => fake()->e164PhoneNumber,
            'periodicity_preventive' => Period::get()->random(),
            'requires_calibration' => YesOrNot::get()->random(),
            'calibration_periodicity' => Period::get()->random(),
            'operation_manual' => YesOrNot::get()->random(),
            'maintenance_manual' => YesOrNot::get()->random(),
            'plan_id' => Plan::get()->random(),
            'use_biomedical_id' => UseBiomedical::get()->random(),
            'biomedical_classification_id' => BiomedicalClassification::get()->random(),
            'risk_class_id' => RiskClass::get()->random(),
            'frequency' => fake()->numberBetween(100,400).' Hz',
            'weight' => fake()->numberBetween(100,1150).' Kg',
            'temperature' => fake()->numberBetween(10,40). ' °C',
            'power_supply' => 'AC',
            'voltage' => '115',
            'description' => fake()->paragraph(1),
            'damaged' => YesOrNot::get()->random(),
            'photo' => fake()->imageUrl(null,null,'avatar'),
        ];
    }
}
