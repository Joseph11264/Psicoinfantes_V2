<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historia_clinicas', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('especialista_id');

            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('especialista_id')->references('id')->on('especialistas'); // No borramos en cascada por auditoría

            // Datos Clínicos
            $table->date('fecha_sesion');
            $table->text('observaciones'); // El desarrollo de la terapia
            $table->string('diagnostico_evolutivo')->nullable(); // Si hay avances o cambios

            $table->timestamps();
        });
    }
};
