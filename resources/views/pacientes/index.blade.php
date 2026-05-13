@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Directorio de Pacientes</h2>
        <p class="text-gray-500 text-sm">Gestión de expedientes y representantes</p>
    </div>
    <a href="{{ route('pacientes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
        + Registrar Paciente
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Paciente</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Representante Legal</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Contacto</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones Clínicas</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pacientes as $paciente)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900">{{ $paciente->nombre_pac }} {{ $paciente->apellido_pac }}</div>
                        <div class="text-xs text-gray-500">Edad: {{ \Carbon\Carbon::parse($paciente->fecha_nac)->age }} años</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $paciente->nombre_rep }}</div>
                        <div class="text-xs text-gray-500">C.I: {{ $paciente->ci_rep }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $paciente->telefono_rep }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center items-center gap-2">
                            
                            <a href="{{ route('pacientes.show', $paciente->id) }}" 
                               class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-full text-xs font-bold uppercase border border-blue-200 transition-colors">
                                Expediente
                            </a>

                            <a href="{{ route('pacientes.edit', $paciente->id) }}" 
                               class="bg-amber-100 text-amber-700 hover:bg-amber-200 px-3 py-1 rounded-full text-xs font-bold uppercase border border-amber-200 transition-colors">
                                Editar
                            </a>

                            <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" onsubmit="return confirm('¿Inhabilitar a este paciente? Sus datos se ocultarán del sistema.');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-xs uppercase pt-1 px-2">
                                    Inhabilitar
                                </button>
                            </form>
                            
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if(isset($pacientes) && count($pacientes) == 0)
            <div class="text-center py-8 text-gray-400">
                <p class="text-sm">No hay pacientes activos en el sistema.</p>
            </div>
        @endif
    </div>
</div>
@endsection