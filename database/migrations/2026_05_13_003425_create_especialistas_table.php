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
        Schema::create('especialistas', function (Blueprint $table) {
    $table->id(); // ID_ESPECIALISTA
    $table->string('cedula_esp', 15)->unique();
    $table->string('nombre_esp', 100);
    $table->string('especialidad', 100);
    $table->string('rol_sistema', 20);
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialistas');
    }
};
