<?php

use App\Models\BiomedicalEquipment\BiomedicalEquipment;
use App\Models\Maintenance\MaintenanceType;
use App\Models\User\User;
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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MaintenanceType::class)->constrained();
            $table->foreignIdFor(BiomedicalEquipment::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->text('observation')->nullable();
            $table->foreignIdFor(User::class, 'created_by')->constrained('users');
            $table->dateTime('scheduled_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
