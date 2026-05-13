@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Generar Factura</h2>
        <p class="text-gray-500 text-sm">Cierre de transacción económica por servicio terapéutico</p>
    </div>

    <div class="bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
        <div class="bg-gray-50 p-6 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-bold text-blue-800 uppercase">Psicoinfantes C.A.</h3>
                    <p class="text-xs text-gray-500">RIF: J-12345678-9</p>
                    <p class="text-xs text-gray-500">Sede Cabudare, Edo. Lara</p>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Documento de Cobro</span>
                    <p class="text-sm font-mono font-bold">Ref-Cita: #00{{ $cita->id }}</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-2 gap-4 mb-8 text-sm">
                <div>
                    <p class="text-gray-400 font-semibold uppercase text-[10px]">Paciente</p>
                    <p class="text-gray-800 font-bold">{{ $cita->paciente->nombre_pac }} {{ $cita->paciente->apellido_pac }}</p>
                </div>
                <div>
                    <p class="text-gray-400 font-semibold uppercase text-[10px]">Especialista</p>
                    <p class="text-gray-800">{{ $cita->especialista->nombre_esp }}</p>
                </div>
                <div>
                    <p class="text-gray-400 font-semibold uppercase text-[10px]">Fecha Servicio</p>
                    <p class="text-gray-800">{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-400 font-semibold uppercase text-[10px]">Área</p>
                    <p class="text-gray-800">{{ $cita->area->nombre_area }}</p>
                </div>
            </div>

            <div class="border-t border-b border-gray-100 py-4 mb-6">
                <div class="flex justify-between py-2">
                    <span class="text-gray-600">Servicio de Terapia Interdisciplinaria</span>
                    <span class="font-mono text-gray-800">${{ number_format($precioBase, 2) }}</span>
                </div>
                <div class="flex justify-between py-2 text-sm">
                    <span class="text-gray-500 italic">IVA (16% Base imponible)</span>
                    <span class="font-mono text-gray-600">+ ${{ number_format($iva, 2) }}</span>
                </div>
            </div>

            <div class="flex justify-between items-center bg-blue-50 p-4 rounded-lg">
                <span class="text-blue-800 font-bold text-lg">TOTAL A PAGAR</span>
                <span class="text-blue-800 font-mono font-black text-2xl">${{ number_format($total, 2) }}</span>
            </div>

            <form action="{{ route('facturas.store') }}" method="POST" class="mt-8">
                @csrf
                <input type="hidden" name="cita_id" value="{{ $cita->id }}">
                <input type="hidden" name="fecha_factura" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="subtotal" value="{{ $precioBase }}">
                <input type="hidden" name="impuesto_iva" value="{{ $iva }}">
                <input type="hidden" name="monto_total" value="{{ $total }}">

                <div class="flex gap-4">
                    <a href="{{ route('citas.index') }}" class="flex-1 text-center py-3 border border-gray-300 rounded-lg text-gray-600 font-bold hover:bg-gray-50 transition-all">
                        Cancelar
                    </a>
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                        </svg>
                        Confirmar Pago y Facturar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection