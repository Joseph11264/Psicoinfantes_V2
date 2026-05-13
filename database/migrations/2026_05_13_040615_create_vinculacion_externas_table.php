<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vinculaciones_externas', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea que conecta con el paciente
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            
            // Datos de la vinculación
            $table->string('tipo_institucion'); // Ej: Escuela, Neurología, Tribunal
            $table->string('nombre_institucion'); // Ej: Unidad Educativa San José
            $table->string('contacto_externo')->nullable(); // Ej: Nombre de la maestra o doctor
            $table->text('motivo_referencia')->nullable(); // Por qué lo enviaron
            $table->date('fecha_vinculacion');
            
            $table->timestamps();
        });
    }
};
