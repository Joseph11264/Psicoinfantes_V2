<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\InfraestructuraAreaController;
use App\Http\Controllers\FacturaController;

// Ruta raíz: Redirige al listado de pacientes o a un dashboard
Route::get('/', function () {
    return redirect()->route('pacientes.index');
});

// Rutas de los Módulos Maestros
Route::resource('pacientes', PacienteController::class);
Route::resource('especialistas', EspecialistaController::class);
Route::resource('areas', InfraestructuraAreaController::class);

// Rutas del Módulo Transaccional
Route::resource('citas', CitaController::class);

Route::get('citas/{cita}/facturar', [FacturaController::class, 'crearFactura'])->name('citas.facturar');
Route::post('facturas/store', [FacturaController::class, 'store'])->name('facturas.store');