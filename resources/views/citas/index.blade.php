@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Calendario de Citas</h2>
        <p class="text-gray-500 text-sm">Control de sesiones y disponibilidad de áreas</p>
    </div>
    <a href="{{ route('citas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-all">
        + Agendar Cita
    </a>
</div>

<div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Fecha / Hora</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Paciente</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Especialista</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Área</th>
                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Estado</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($citas as $cita)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</div>
                    <div class="text-xs text-gray-500">{{ $cita->hora_cita }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                    {{ $cita->paciente->nombre_pac }} {{ $cita->paciente->apellido_pac }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                    {{ $cita->especialista->nombre_esp }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                    {{ $cita->area->nombre_area }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                                        
                    @if($cita->estado === 'Facturada')
                        @php $factura = \App\Models\Factura::where('cita_id', $cita->id)->first(); @endphp
                        
                        @if($factura)
                            <a href="{{ route('facturas.show', $factura->id) }}" 
                            class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-full text-xs font-bold uppercase border border-blue-200 transition-colors">
                                Ver Factura
                            </a>
                        @endif
                    @else
                        <a href="{{ route('citas.facturar', $cita->id) }}" 
                        class="bg-green-100 text-green-700 hover:bg-green-200 px-3 py-1 rounded-full text-xs font-bold uppercase border border-green-200">
                            Cobrar
                        </a>
                    @endif
                    
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($citas->isEmpty())
        <div class="p-10 text-center text-gray-400">No hay citas programadas para hoy.</div>
    @endif

    <div class="flex gap-2">
        <a href="{{ route('reportes.asistencia') }}" target="_blank" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-all">
            🖨️ Imprimir Asistencia de Hoy
        </a>
        <a href="{{ route('citas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-all">
            + Agendar Cita
        </a>
    </div>

</div>
@endsection