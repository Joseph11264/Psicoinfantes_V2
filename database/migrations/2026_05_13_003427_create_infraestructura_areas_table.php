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
        Schema::create('infraestructura_areas', function (Blueprint $table) {
    $table->id(); // ID_AREA
    $table->string('nombre_area', 100);
    $table->string('nivel_estimulo', 50);
    $table->boolean('disponibilidad')->default(true);
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infraestructura_areas');
    }
};
