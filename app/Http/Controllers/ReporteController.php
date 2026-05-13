<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Paciente;
use App\Models\Cita;
use Carbon\Carbon;

class ReporteController extends Controller
{
    // Reporte Operativo 1: Ficha del Paciente
    public function fichaPaciente(Paciente $paciente) {
        $pdf = Pdf::loadView('reportes.ficha-paciente', compact('paciente'));
        return $pdf->stream('Ficha-'.$paciente->nombre_pac.'.pdf'); // stream abre en el navegador en vez de forzar descarga
    }

    // Reporte Operativo 2: Ticket / Comprobante de Cita
    public function comprobanteCita(Cita $cita) {
        $pdf = Pdf::loadView('reportes.comprobante-cita', compact('cita'));
        // Formato tipo ticket o media carta
        $pdf->setPaper('A5', 'landscape');
        return $pdf->stream('Comprobante-Cita-00'.$cita->id.'.pdf');
    }

    // Reporte Operativo 3: Lista de Asistencia Diaria
    public function asistenciaDiaria() {
        $hoy = Carbon::today()->toDateString();
        // Traemos las citas de hoy ordenadas por hora
        $citas = Cita::with(['paciente', 'especialista', 'area'])
                     ->where('fecha_cita', $hoy)
                     ->orderBy('hora_cita', 'asc')
                     ->get();
                     
        $pdf = Pdf::loadView('reportes.asistencia-diaria', compact('citas', 'hoy'));
        return $pdf->stream('Asistencia-Diaria-'.$hoy.'.pdf');
    }

    // Reporte de Supervisión: Control de Facturación Diario
    public function facturacionDiaria() {
        $hoy = Carbon::today()->toDateString();
        
        // Traemos las facturas de hoy junto con los datos de la cita y el paciente
        $facturas = \App\Models\Factura::with('cita.paciente')
                        ->where('fecha_factura', $hoy)
                        ->get();
                        
        // Cálculo automático de totales para la gerencia
        $totalSubtotal = $facturas->sum('subtotal');
        $totalIva = $facturas->sum('impuesto_iva');
        $totalRecaudado = $facturas->sum('monto_total');
        
        $pdf = Pdf::loadView('reportes.facturacion-diaria', compact('facturas', 'hoy', 'totalSubtotal', 'totalIva', 'totalRecaudado'));
        return $pdf->stream('Cierre-Facturacion-'.$hoy.'.pdf');
    }

    // Reporte Gerencial: Estadísticas de Diagnósticos Frecuentes
    public function diagnosticosFrecuentes() {
        // Agrupamos las patologías y contamos cuántas veces se repite cada una
        $diagnosticos = \App\Models\Diagnostico::selectRaw('patologia, count(*) as total_casos')
                        ->groupBy('patologia')
                        ->orderBy('total_casos', 'desc')
                        ->get();
                        
        $totalPacientes = $diagnosticos->sum('total_casos');
        
        $pdf = Pdf::loadView('reportes.diagnosticos-frecuentes', compact('diagnosticos', 'totalPacientes'));
        return $pdf->stream('Estadistica-Diagnosticos.pdf');
    }

    // Reporte 5: Citas por Especialista (Supervisión)
    public function citasEspecialista() {
        // Cuenta cuántas citas tiene asignadas cada especialista
        $especialistas = \App\Models\Especialista::withCount('citas')->get();
        $pdf = Pdf::loadView('reportes.citas-especialista', compact('especialistas'));
        return $pdf->stream('Carga-Especialistas.pdf');
    }

    // Reporte 6: Uso de Infraestructura (Supervisión)
    public function usoInfraestructura() {
        // Cuenta cuántas veces se ha agendado cada área (Neuroarquitectura)
        $areas = \App\Models\InfraestructuraArea::withCount('citas')->orderBy('citas_count', 'desc')->get();
        $pdf = Pdf::loadView('reportes.uso-infraestructura', compact('areas'));
        return $pdf->stream('Uso-Infraestructura.pdf');
    }

    // Reporte 8: Resumen Mensual de Ingresos (Gerencial)
    public function ingresosMensuales() {
        // Agrupa las facturas por mes y suma los montos totales de forma dinámica
        $meses = \App\Models\Factura::all()->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->fecha_factura)->isoFormat('MMMM YYYY');
        })->map(function($grupo) {
            return [
                'cantidad_facturas' => $grupo->count(),
                'total_recaudado' => $grupo->sum('monto_total')
            ];
        });
        
        $pdf = Pdf::loadView('reportes.ingresos-mensuales', compact('meses'));
        return $pdf->stream('Ingresos-Mensuales.pdf');
    }

    // Reporte 9: Rendimiento de Terapeutas (Gerencial)
    public function rendimientoTerapeutas() {
        // Mide la efectividad: Citas que realmente se concretaron (Facturadas)
        $rendimiento = \App\Models\Especialista::withCount(['citas as citas_completadas' => function ($query) {
            $query->where('estado', 'Facturada');
        }])->orderBy('citas_completadas', 'desc')->get();
        
        $pdf = Pdf::loadView('reportes.rendimiento-terapeutas', compact('rendimiento'));
        return $pdf->stream('Rendimiento-Terapeutas.pdf');
    }
}