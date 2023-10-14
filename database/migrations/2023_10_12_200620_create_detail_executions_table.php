<?php

use App\Models\BiomedicalEquipment\MaintenanceItem;
use App\Models\BiomedicalEquipment\YesOrNot;
use App\Models\Maintenance\MaintenanceExecution;
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
        Schema::create('detail_executions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MaintenanceExecution::class)->constrained();
            $table->foreignIdFor(MaintenanceItem::class)->constrained();
            $table->foreignIdFor(YesOrNot::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_executions');
    }
};
