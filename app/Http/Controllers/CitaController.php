<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Especialista;
use App\Models\InfraestructuraArea;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Mostrar todas las citas agendadas
    public function index() {
        // Usamos 'with' para traer los datos relacionados y no solo los IDs (Eager Loading)
        $citas = Cita::with(['paciente', 'especialista', 'area'])->get();
        return view('citas.index', compact('citas'));
    }

    // Cargar el formulario con los combos (Selectores)
    public function create() {
        $pacientes = Paciente::all();
        $especialistas = Especialista::all();
        $areas = InfraestructuraArea::where('disponibilidad', true)->get(); // Solo áreas disponibles

        return view('citas.create', compact('pacientes', 'especialistas', 'areas'));
    }

    // Guardar la transacción en la base de datos
    public function store(Request $request) {
    // 1. Validación: Ahora solo pedimos que sea una fecha válida (incluyendo hoy)
    $request->validate([
        'fecha_cita' => 'required|date', 
        'hora_cita' => 'required',
        'paciente_id' => 'required|exists:pacientes,id',
        'especialista_id' => 'required|exists:especialistas,id',
        'area_id' => 'required|exists:infraestructura_areas,id',
    ]);

    // 2. Lógica de Negocio: Verificar disponibilidad real
    // Comprobamos si el especialista ya tiene una cita ese mismo día a esa misma hora
    $conflicto = Cita::where('especialista_id', $request->especialista_id)
                     ->where('fecha_cita', $request->fecha_cita)
                     ->where('hora_cita', $request->hora_cita)
                     ->exists();

    if ($conflicto) {
        return back()->withInput()->withErrors(['error' => 'El especialista ya tiene una cita ocupada en este horario.']);
    }

    // 3. Guardar
    Cita::create($request->all());

    return redirect()->route('citas.index')->with('success', 'Cita agendada exitosamente para hoy.');
    }
}