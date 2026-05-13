@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
        <div class="bg-blue-600 p-8 text-white flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold uppercase tracking-widest">Factura</h1>
                <p class="text-blue-100 mt-1 italic">Psicoinfantes v1.0</p>
            </div>
            <div class="text-right">
                <p class="font-bold">Nº Control: #{{ str_pad($factura->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p class="text-sm text-blue-100">Fecha: {{ \Carbon\Carbon::parse($factura->fecha_factura)->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-2 gap-8 mb-10">
                <div>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-2">Facturado a:</h3>
                    <p class="text-lg font-bold text-gray-800">{{ $factura->cita->paciente->nombre_pac }} {{ $factura->cita->paciente->apellido_pac }}</p>
                    <p class="text-sm text-gray-600">Representante: {{ $factura->cita->paciente->nombre_rep }}</p>
                </div>
                <div class="text-right">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-2">Estado del Pago:</h3>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase bg-green-100 text-green-700 border border-green-200">
                        {{ $factura->estado_pago }}
                    </span>
                </div>
            </div>

            <table class="w-full mb-10">
                <thead>
                    <tr class="border-b-2 border-gray-100 text-left">
                        <th class="py-3 text-xs font-black text-gray-400 uppercase">Descripción del Servicio</th>
                        <th class="py-3 text-right text-xs font-black text-gray-400 uppercase">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-50">
                        <td class="py-4">
                            <p class="font-bold text-gray-800">Servicio de Especialidad: {{ $factura->cita->especialista->especialidad }}</p>
                            <p class="text-xs text-gray-500">Atendido por: {{ $factura->cita->especialista->nombre_esp }}</p>
                        </td>
                        <td class="py-4 text-right font-medium text-gray-700">
                            ${{ number_format($factura->subtotal, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-end">
                <div class="w-64 space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal:</span>
                        <span class="font-semibold">${{ number_format($factura->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>IVA (16%):</span>
                        <span class="font-semibold">${{ number_format($factura->impuesto_iva, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-xl font-bold text-blue-800 border-t pt-3">
                        <span>Total:</span>
                        <span>${{ number_format($factura->monto_total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 text-center border-t border-gray-200">
            <p class="text-xs text-gray-400">Gracias por confiar en Psicoinfantes. Este es un comprobante digital de pago.</p>
            <div class="mt-4 flex justify-center gap-4">
                <button onclick="window.print()" class="bg-gray-800 hover:bg-black text-white px-6 py-2 rounded-lg text-xs font-bold uppercase transition-all">
                    Imprimir Comprobante
                </button>
                <a href="{{ route('citas.index') }}" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-6 py-2 rounded-lg text-xs font-bold uppercase transition-all">
                    Volver a Agenda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection