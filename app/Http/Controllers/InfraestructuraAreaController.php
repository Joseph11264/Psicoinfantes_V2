<?php

namespace App\Http\Controllers;

use App\Models\InfraestructuraArea;
use Illuminate\Http\Request;

class InfraestructuraAreaController extends Controller
{
    public function index()
    {
        $areas = InfraestructuraArea::all();
        return view('areas.index', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_area' => 'required|string|max:150',
            'nivel_estimulo' => 'required|string|max:50',
        ]);

        InfraestructuraArea::create($request->all());
        return redirect()->route('areas.index')->with('success', 'Nueva área registrada en la clínica.');
    }

    public function edit(InfraestructuraArea $area)
    {
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, InfraestructuraArea $area)
    {
        $request->validate([
            'nombre_area' => 'required|string|max:150',
            'nivel_estimulo' => 'required|string|max:50',
        ]);

        $area->update($request->all());
        return redirect()->route('areas.index')->with('success', 'Datos del área actualizados correctamente.');
    }

    public function destroy(InfraestructuraArea $area)
    {
        $area->delete();
        return redirect()->route('areas.index')->with('success', 'El área ha sido inhabilitada para nuevas citas.');
    }
}