<?php

namespace App\Http\Controllers;

use App\Models\VinculacionExterna;
use Illuminate\Http\Request;

class VinculacionExternaController extends Controller
{
    /**
     * Almacena una nueva vinculación externa desde el expediente del paciente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'tipo_institucion' => 'required|string|max:100',
            'nombre_institucion' => 'required|string|max:150',
            'fecha_vinculacion' => 'required|date',
            'contacto_externo' => 'nullable|string|max:150',
            'motivo_referencia' => 'nullable|string',
        ]);

        VinculacionExterna::create($request->all());

        return back()->with('success', 'La institución ha sido vinculada al expediente del paciente.');
    }

    /**
     * Elimina una vinculación específica.
     */
    public function destroy(VinculacionExterna $vinculacion)
    {
        $vinculacion->delete();
        return back()->with('success', 'Vinculación externa eliminada.');
    }
}