<?php

use App\Models\Maintenance\Maintenance;
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
        Schema::create('maintenance_executions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Maintenance::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('boss_signature')->nullable();
            $table->text('materials')->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_executions');
    }
};
