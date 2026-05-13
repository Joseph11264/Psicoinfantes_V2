<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function crearFactura(Cita $cita) {
        // Precio base fijo por terapia (Ejemplo: 30$)
        $precioBase = 30.00;
        $ivaPorcentaje = 0.16;
        
        $iva = $precioBase * $ivaPorcentaje;
        $total = $precioBase + $iva;

        return view('facturas.create', compact('cita', 'precioBase', 'iva', 'total'));
    }

    public function store(Request $request) {
        Factura::create($request->all());
        
        // Al facturar, podemos cambiar el estado de la cita a 'Completada'
        $cita = Cita::find($request->cita_id);
        $cita->update(['estado' => 'Facturada']);

        return redirect()->route('citas.index')->with('success', 'Factura generada y cálculos procesados.');
    }
}