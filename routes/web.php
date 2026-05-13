<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\InfraestructuraAreaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\VinculacionExternaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirigir la raíz directamente a la pantalla de Login
Route::get('/', function () {
    return redirect()->route('login');
});

// El Dashboard de Breeze ahora carga la vista de tu Centro de Reportes
Route::get('/dashboard', function () {
    return view('reportes.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// Agrupamos todas las rutas que requieren que el usuario esté autenticado
Route::middleware('auth')->group(function () {
    
    // Rutas de Perfil (Generadas por Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de los Módulos Maestros
    Route::resource('pacientes', PacienteController::class);
    Route::resource('especialistas', EspecialistaController::class);
    Route::resource('areas', InfraestructuraAreaController::class);

    // Rutas del Módulo Transaccional
    Route::resource('citas', CitaController::class);

    // Rutas del Módulo de Facturación
    Route::get('citas/{cita}/facturar', [FacturaController::class, 'crearFactura'])->name('citas.facturar');
    Route::post('facturas/store', [FacturaController::class, 'store'])->name('facturas.store');

    // Rutas de Reportes Operativos
    Route::get('reportes/ficha/{paciente}', [ReporteController::class, 'fichaPaciente'])->name('reportes.ficha');
    Route::get('reportes/comprobante/{cita}', [ReporteController::class, 'comprobanteCita'])->name('reportes.comprobante');
    Route::get('reportes/asistencia-diaria', [ReporteController::class, 'asistenciaDiaria'])->name('reportes.asistencia');

    // Rutas de Reportes de Supervisión y Gerenciales
    Route::get('reportes/facturacion-diaria', [ReporteController::class, 'facturacionDiaria'])->name('reportes.facturacion');
    Route::get('reportes/diagnosticos', [ReporteController::class, 'diagnosticosFrecuentes'])->name('reportes.diagnosticos');
    Route::get('reportes/citas-especialista', [ReporteController::class, 'citasEspecialista'])->name('reportes.citas_especialista');
    Route::get('reportes/uso-infraestructura', [ReporteController::class, 'usoInfraestructura'])->name('reportes.uso_infraestructura');
    Route::get('reportes/ingresos-mensuales', [ReporteController::class, 'ingresosMensuales'])->name('reportes.ingresos_mensuales');
    Route::get('reportes/rendimiento-terapeutas', [ReporteController::class, 'rendimientoTerapeutas'])->name('reportes.rendimiento_terapeutas');
    Route::post('historias/store', [HistoriaClinicaController::class, 'store'])->name('historias.store');

    Route::resource('vinculaciones', VinculacionExternaController::class);

    Route::resource('vinculaciones', VinculacionExternaController::class);
    Route::post('historias/store', [HistoriaClinicaController::class, 'store'])->name('historias.store');
    Route::get('facturas/{factura}', [FacturaController::class, 'show'])->name('facturas.show');

    // Módulo de Gestión de Usuarios (Protegido para el Gerente)
    Route::resource('users', UserController::class)->middleware('role:gerente');
});

require __DIR__.'/auth.php';