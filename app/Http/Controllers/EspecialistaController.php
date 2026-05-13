<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use Illuminate\Http\Request;

class EspecialistaController extends Controller
{
    public function index() {
        $especialistas = Especialista::all();
        return view('especialistas.index', compact('especialistas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cedula_esp' => 'required|string|max:20',
            'nombre_esp' => 'required|string|max:100',
            'especialidad' => 'required|array|min:1', // Exigimos que sea un arreglo y marque al menos 1
            'rol_sistema' => 'required|string',
        ]);

        $datos = $request->all();
        // Unimos las especialidades marcadas con una coma: "Psicología, Terapia"
        $datos['especialidad'] = implode(', ', $request->especialidad);

        Especialista::create($datos);
        return redirect()->route('especialistas.index')->with('success', 'Especialista registrado correctamente.');
    }

    public function update(Request $request, Especialista $especialista)
    {
        $request->validate([
            'nombre_esp' => 'required|string|max:100',
            'especialidad' => 'required|array|min:1', // Igual aquí
            'rol_sistema' => 'required|string',
        ]);

        $datos = $request->all();
        $datos['especialidad'] = implode(', ', $request->especialidad);

        $especialista->update($datos);
        return redirect()->route('especialistas.index')->with('success', 'Datos del especialista actualizados.');
    }

    public function destroy(Especialista $especialista)
    {
        $especialista->delete(); // Inhabilitación lógica
        return redirect()->route('especialistas.index')->with('success', 'Especialista inhabilitado correctamente.');
    }

    public function edit(Especialista $especialista)
    {
        return view('especialistas.edit', compact('especialista'));
    }
}