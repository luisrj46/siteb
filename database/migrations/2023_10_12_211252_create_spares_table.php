<?php

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
        Schema::create('spares', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MaintenanceExecution::class)->constrained();
            $table->string('name');
            $table->unsignedInteger('quantity');
            $table->unsignedDouble('cost')->nullable();
            $table->string('series')->nullable();
            $table->string('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spares');
    }
};
