<?php

namespace App\Http\Controllers;

use App\Models\InfraestructuraArea;
use Illuminate\Http\Request;

class InfraestructuraAreaController extends Controller
{
    public function index() {
        $areas = InfraestructuraArea::all();
        return view('areas.index', compact('areas'));
    }

    public function store(Request $request) {
        $request->validate([
            'nombre_area' => 'required|string|max:100',
            'nivel_estimulo' => 'required|string|max:50',
        ]);

        // Capturamos los datos y verificamos el checkbox
        $data = $request->all();
        $data['disponibilidad'] = $request->has('disponibilidad');

        InfraestructuraArea::create($data);
        return redirect()->route('areas.index')->with('success', 'Área de infraestructura registrada.');
    }

    public function destroy($id) {
        $area = InfraestructuraArea::findOrFail($id);
        $area->delete();
        return redirect()->route('areas.index')->with('success', 'Área eliminada del sistema.');
    }
}