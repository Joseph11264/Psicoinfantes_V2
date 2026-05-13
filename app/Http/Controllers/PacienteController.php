<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    // Listar pacientes (Consultar)
    public function index() {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    // Guardar nuevo (Incluir)
    public function store(Request $request) {
        $request->validate([
            'ci_rep' => 'required|string|max:20',
            'nombre_pac' => 'required|string|max:100',
            'fecha_nac' => 'required|date',
        ]);

        Paciente::create($request->all());
        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado con éxito');
    }

    // Actualizar (Modificar)
    public function update(Request $request, Paciente $paciente) {
        $paciente->update($request->all());
        return redirect()->route('pacientes.index')->with('success', 'Datos actualizados');
    }

    // Eliminar
    public function destroy(Paciente $paciente) {
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado');
    }
}