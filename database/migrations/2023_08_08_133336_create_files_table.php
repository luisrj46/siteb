<?php

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
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('fileable');
            $table->text('path')->nullable();
            $table->string('field', 35)->index()->nullable()->comment("Este campo se debe enviar como bandera para saber a que campo del formulario pertenece, 'Ejemplo: para los videos de la propiedad se enviaria video para poder obtener todos los archivos que se ingresaron en el campo de video del formulario'");
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
