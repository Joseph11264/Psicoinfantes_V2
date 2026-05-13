<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Definimos los 3 roles sugeridos. Por defecto será 'recepcionista'.
        $table->enum('role', ['gerente', 'especialista', 'recepcionista'])->default('recepcionista');
    });
}
};
