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
        Schema::create('formaciones_especialistas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('especialista_id')->constrained('especialistas')->onDelete('cascade');
    $table->string('certificacion', 255);
    $table->date('fecha_obtencion')->nullable();
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacion_especialistas');
    }
};
