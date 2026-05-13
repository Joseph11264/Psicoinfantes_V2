@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Registrar Factura (IVA 16%)</h2>

    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf
        <input type="hidden" name="cita_id" value="{{ $cita->id }}">

        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase">Monto Subtotal ($/Bs)</label>
                <input type="number" step="0.01" name="subtotal" id="subtotal" required 
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">Impuesto IVA (16%)</p>
                    <p id="iva_res" class="text-lg font-semibold text-gray-700">0.00</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">Monto Total</p>
                    <p id="total_res" class="text-xl font-black text-blue-700">0.00</p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase">Fecha de Emisión</label>
                <input type="date" name="fecha_factura" value="{{ date('Y-m-d') }}" required 
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg transition-all uppercase tracking-wider">
                Confirmar y Procesar Pago
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('subtotal').addEventListener('input', function() {
        let subtotal = parseFloat(this.value) || 0;
        let iva = subtotal * 0.16;
        let total = subtotal + iva;
        
        document.getElementById('iva_res').innerText = iva.toFixed(2);
        document.getElementById('total_res').innerText = total.toFixed(2);
    });
</script>
@endsection