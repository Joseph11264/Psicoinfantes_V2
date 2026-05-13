<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PacienteController extends Controller
{
    // Listar pacientes (Consultar)
    public function index() {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    // Muestra el formulario para registrar un nuevo paciente
    public function create()
    {
        return view('pacientes.create');
    }

    // Procesa y guarda los datos enviados desde el formulario
    public function store(Request $request)
    {
        $request->validate([
            'nombre_pac' => 'required|string|max:100',
            'apellido_pac' => 'required|string|max:100',
            'fecha_nac' => 'required|date',
            'ci_rep' => 'required|string|max:20',
            'nombre_rep' => 'required|string|max:150',
            'telefono_rep' => 'required|string|max:20',
        ]);

        \App\Models\Paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado exitosamente en el sistema.');
    }

    // Procesar la actualización de datos
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre_pac' => 'required|string|max:100',
            'apellido_pac' => 'required|string|max:100',
            'fecha_nac' => 'required|date',
            'ci_rep' => 'required|string|max:20',
            'nombre_rep' => 'required|string|max:150',
            'telefono_rep' => 'required|string|max:20',
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Datos del paciente actualizados correctamente.');
    }

        // Inhabilitar al paciente (Soft Delete)
        public function destroy(Paciente $paciente)
        {
            $paciente->delete(); // Laravel llenará la columna deleted_at automáticamente
            return redirect()->route('pacientes.index')->with('success', 'El paciente ha sido inhabilitado del sistema.');
        }

        public function edit(Paciente $paciente)
        {
            return view('pacientes.edit', compact('paciente'));
        }

        public function descargarFicha(Paciente $paciente) {
        $pdf = Pdf::loadView('reportes.ficha-paciente', compact('paciente'));
        return $pdf->download('Ficha-'.$paciente->nombre_pac.'.pdf');
    }

    public function show(Paciente $paciente)
    {
        // Obtenemos los especialistas para el formulario de notas
        $especialistas = \App\Models\Especialista::all(); 
        return view('pacientes.show', compact('paciente', 'especialistas'));
    }
}