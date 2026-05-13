<?php
namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'especialista_id' => 'required|exists:especialistas,id',
            'fecha_sesion' => 'required|date',
            'observaciones' => 'required|string',
            'diagnostico_evolutivo' => 'nullable|string|max:255',
        ]);

        HistoriaClinica::create($request->all());

        return back()->with('success', 'Nota de evolución guardada correctamente en la historia clínica.');
    }
}