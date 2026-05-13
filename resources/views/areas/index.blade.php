@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Infraestructura y Áreas</h2>
    <p class="text-gray-500 text-sm">Gestión de consultorios bajo normas de neuroarquitectura</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <p class="font-bold">¡Operación exitosa!</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-1 border border-gray-100">
        <h3 class="text-lg font-bold mb-4 text-blue-700 border-b pb-2">Registrar Espacio</h3>
        
        <form action="{{ route('areas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre del Área</label>
                <input type="text" name="nombre_area" required placeholder="Ej: Sala Multisensorial A" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nivel de Estímulo</label>
                <select name="nivel_estimulo" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
                    <option value="">Seleccione el nivel...</option>
                    <option value="Bajo (Relajación)">Bajo (Relajación)</option>
                    <option value="Medio (Interactivo)">Medio (Interactivo)</option>
                    <option value="Alto (Dinámico)">Alto (Dinámico)</option>
                </select>
            </div>
            
            <div class="mb-5 flex items-center">
                <input type="checkbox" name="disponibilidad" id="disponibilidad" checked class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="disponibilidad" class="ml-2 block text-sm font-semibold text-gray-700">Área disponible para uso</label>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg transition-colors shadow-md">
                Guardar Área
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-2 border border-gray-100">
        <h3 class="text-lg font-bold mb-4 text-gray-700 border-b pb-2">Espacios Registrados</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Área</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Estímulo</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase">Estado</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($areas as $area)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $area->nombre_area }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ $area->nivel_estimulo }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-center">
                            @if($area->disponibilidad)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disponible</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ocupada / Mantenimiento</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <form action="{{ route('areas.destroy', $area->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar esta área física del sistema?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-800 font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($areas->isEmpty())
                <div class="text-center py-8 text-gray-400 text-sm">No hay áreas de infraestructura registradas.</div>
            @endif
        </div>
    </div>
</div>
@endsection