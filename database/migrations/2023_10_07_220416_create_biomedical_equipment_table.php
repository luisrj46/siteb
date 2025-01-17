<?php

use App\Models\BiomedicalEquipment\BiomedicalClassification;
use App\Models\BiomedicalEquipment\FormAcquisition;
use App\Models\BiomedicalEquipment\Period;
use App\Models\BiomedicalEquipment\Plan;
use App\Models\BiomedicalEquipment\Property;
use App\Models\BiomedicalEquipment\RiskClass;
use App\Models\BiomedicalEquipment\Service;
use App\Models\BiomedicalEquipment\UseBiomedical;
use App\Models\BiomedicalEquipment\Voltage;
use App\Models\BiomedicalEquipment\YesOrNot;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biomedical_equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('series')->nullable();
            $table->string('active_code')->nullable();
            $table->boolean('is_enabled')->default(1);
            $table->foreignIdFor(Service::class)->nullable()->constrained();
            $table->string('ambient')->nullable();
            $table->string('invima_register')->nullable();
            $table->string('cost')->nullable();
            $table->foreignIdFor(Property::class)->nullable()->constrained();
            $table->foreignIdFor(FormAcquisition::class)->nullable()->constrained();
            $table->date('date_purchase')->nullable();
            $table->string('reception_condition')->nullable();
            $table->unsignedSmallInteger('year_production')->nullable();
            $table->string('maker')->nullable();
            $table->bigInteger('manufacturer_phone')->nullable();
            $table->string('representative')->nullable();
            $table->bigInteger('representative_phone')->nullable();
            $table->foreignIdFor(Period::class, 'periodicity_preventive')->nullable()->constrained('periods');
            $table->foreignIdFor(YesOrNot::class, 'requires_calibration')->nullable()->constrained('yes_or_nots');
            $table->foreignIdFor(Period::class, 'calibration_periodicity')->nullable()->constrained('periods');
            $table->foreignIdFor(YesOrNot::class, 'operation_manual')->nullable()->constrained('yes_or_nots');
            $table->foreignIdFor(YesOrNot::class, 'maintenance_manual')->nullable()->constrained('yes_or_nots');
            $table->foreignIdFor(Plan::class)->nullable()->constrained();
            $table->foreignIdFor(UseBiomedical::class)->nullable()->constrained();
            $table->foreignIdFor(BiomedicalClassification::class)->nullable()->constrained();
            $table->foreignIdFor(RiskClass::class)->nullable()->constrained();
            $table->string('power_supply')->nullable();
            $table->string('frequency')->nullable();
            $table->string('weight')->nullable();
            $table->string('temperature')->nullable();
            $table->string('voltage')->nullable();
            $table->string('description')->nullable();
            $table->string('photo')->nullable();
            $table->foreignIdFor(YesOrNot::class, 'damaged')->nullable()->constrained('yes_or_nots');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biomedical_equipment');
    }
};
