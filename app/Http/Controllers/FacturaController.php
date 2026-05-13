<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cita;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // Muestra la pantalla para cobrar una cita específica
    public function crearFactura(Cita $cita)
    {
        // Validación de seguridad: Evitar cobrar dos veces
        if ($cita->estado === 'Facturada') {
            return redirect()->route('citas.index')->with('error', 'Operación denegada: Esta cita ya fue pagada y facturada.');
        }

        return view('facturas.create', compact('cita'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cita_id' => 'required|exists:citas,id',
            'subtotal' => 'required|numeric|min:0.01',
            'fecha_factura' => 'required|date',
        ]);

        // Cálculo del IVA basado en tu estructura
        $subtotal = $request->subtotal;
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;

        Factura::create([
            'cita_id' => $request->cita_id,
            'fecha_factura' => $request->fecha_factura,
            'subtotal' => $subtotal,
            'impuesto_iva' => $iva,
            'monto_total' => $total,
            'estado_pago' => 'Pagado', // Cambiamos el default 'Pendiente' a 'Pagado'
        ]);

        // Marcar la cita como facturada
        $cita = \App\Models\Cita::find($request->cita_id);
        $cita->estado = 'Facturada';
        $cita->save();

        return redirect()->route('citas.index')->with('success', 'Factura generada con IVA del 16%.');
    }

    public function show(Factura $factura)
    {
        // Cargamos la relación con la cita y el paciente para mostrar los nombres
        $factura->load(['cita.paciente', 'cita.especialista']);
        
        return view('facturas.show', compact('factura'));
    }
}