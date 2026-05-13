@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Gestión de Pacientes</h2>
    <p class="text-gray-500 text-sm">Módulo maestro de registro y directorio</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
        <p class="font-bold">¡Operación exitosa!</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-1 border border-gray-100">
        <h3 class="text-lg font-bold mb-4 text-blue-700 border-b pb-2">Nuevo Ingreso</h3>
        
        <form action="{{ route('pacientes.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">C.I. Representante</label>
                <input type="text" name="ci_rep" required placeholder="Ej: V-12345678" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre Representante</label>
                <input type="text" name="nombre_rep" required 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombres del Paciente</label>
                <input type="text" name="nombre_pac" required 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Apellidos del Paciente</label>
                <input type="text" name="apellido_pac" required 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
            </div>
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nac" required 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
            </div>
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg transition-colors shadow-md">
                Guardar Paciente
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-2 border border-gray-100">
        <h3 class="text-lg font-bold mb-4 text-gray-700 border-b pb-2">Directorio Activo</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Paciente</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Representante</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pacientes as $paciente)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $paciente->nombre_pac }} {{ $paciente->apellido_pac }}</div>
                            <div class="text-xs text-gray-500">Nac: {{ $paciente->fecha_nac }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-700">{{ $paciente->nombre_rep }}</div>
                            <div class="text-xs font-mono text-gray-500">{{ $paciente->ci_rep }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 mr-3 font-semibold">Editar</button>
                            
                            <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Confirma que desea eliminar definitivamente este registro del sistema?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-800 font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($pacientes->isEmpty())
                <div class="text-center py-8 text-gray-400">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <p class="text-sm">No hay pacientes registrados en el sistema.</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection