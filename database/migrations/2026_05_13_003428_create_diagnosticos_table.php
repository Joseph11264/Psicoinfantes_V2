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
        Schema::create('diagnosticos', function (Blueprint $table) {
    $table->id(); // ID_DIAGNOSTICO
    $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
    $table->string('patologia', 255);
    $table->string('derivacion', 100);
    $table->date('fecha_emision');
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
