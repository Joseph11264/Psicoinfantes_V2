@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Gestión de Especialistas</h2>
    <p class="text-gray-500 text-sm">Registro del personal médico y terapéutico</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <p class="font-bold">¡Operación exitosa!</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-1 border border-gray-100">
        <h3 class="text-lg font-bold mb-4 text-blue-700 border-b pb-2">Registrar Especialista</h3>
        
        <form action="{{ route('especialistas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Cédula</label>
                <input type="text" name="cedula_esp" required placeholder="Ej: V-12345678" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo</label>
                <input type="text" name="nombre_esp" required 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Especialidad</label>
                <select name="especialidad" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
                    <option value="">Seleccione una especialidad...</option>
                    <option value="Psicología Infantil">Psicología Infantil</option>
                    <option value="Terapia del Lenguaje">Terapia del Lenguaje</option>
                    <option value="Psicopedagogía">Psicopedagogía</option>
                    <option value="Terapia Ocupacional">Terapia Ocupacional</option>
                </select>
            </div>
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Rol en el Sistema</label>
                <select name="rol_sistema" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
                    <option value="Psicologo">Psicólogo / Terapeuta</option>
                    <option value="Director">Director Clínico</option>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg transition-colors shadow-md">
                Registrar Personal
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-2 border border-gray-100">
        <h3 class="text-lg font-bold mb-4 text-gray-700 border-b pb-2">Personal Activo</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Especialista</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Especialidad / Rol</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($especialistas as $esp)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $esp->nombre_esp }}</div>
                            <div class="text-xs text-gray-500">C.I: {{ $esp->cedula_esp }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $esp->especialidad }}
                            </span>
                            <div class="text-xs text-gray-500 mt-1">Rol: {{ $esp->rol_sistema }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 mr-3 font-semibold">Editar</button>
                            <form action="{{ route('especialistas.destroy', $esp->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar a este especialista del sistema?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-800 font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($especialistas->isEmpty())
                <div class="text-center py-8 text-gray-400">
                    <p class="text-sm">No hay especialistas registrados en el sistema.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection