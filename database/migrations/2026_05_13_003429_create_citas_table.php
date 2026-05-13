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
        Schema::create('citas', function (Blueprint $table) {
    $table->id(); // ID_CITA
    $table->date('fecha_cita');
    $table->time('hora_cita');
    $table->foreignId('paciente_id')->constrained('pacientes');
    $table->foreignId('especialista_id')->constrained('especialistas');
    $table->foreignId('area_id')->constrained('infraestructura_areas');
    $table->string('estado', 20)->default('Programada'); // Programada, Asistida, Cancelada
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
