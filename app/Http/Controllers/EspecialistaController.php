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

    public function store(Request $request) {
        $request->validate([
            'cedula_esp' => 'required|string|max:15|unique:especialistas',
            'nombre_esp' => 'required|string|max:100',
            'especialidad' => 'required|string|max:100',
            'rol_sistema' => 'required|string|max:20',
        ]);

        Especialista::create($request->all());
        return redirect()->route('especialistas.index')->with('success', 'Especialista registrado correctamente en el sistema.');
    }

    public function destroy(Especialista $especialista) {
        $especialista->delete();
        return redirect()->route('especialistas.index')->with('success', 'Especialista eliminado del directorio.');
    }
}