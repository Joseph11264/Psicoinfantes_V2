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
        Schema::create('facturas', function (Blueprint $table) {
    $table->id(); // ID_FACTURA
    $table->foreignId('cita_id')->constrained('citas');
    $table->date('fecha_factura');
    $table->decimal('subtotal', 10, 2);    // Añadido
    $table->decimal('impuesto_iva', 10, 2); // Añadido
    $table->decimal('monto_total', 10, 2);
    $table->string('estado_pago', 20)->default('Pendiente');
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
