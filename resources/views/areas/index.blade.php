@extends('layouts.app')

@section('content')
<div class="mb-6 border-b pb-4">
    <h2 class="text-3xl font-bold text-gray-800">Gestión de Infraestructura</h2>
    <p class="text-gray-500 text-sm mt-1">Administración de consultorios y espacios de neuroarquitectura.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-blue-500 lg:col-span-1 h-fit">
        <h3 class="text-lg font-bold mb-4 text-blue-800">Registrar Nuevo Espacio</h3>
        
        <form action="{{ route('areas.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nombre del Consultorio / Área</label>
                <input type="text" name="nombre_area" required placeholder="Ej: Sala Multisensorial" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2 border">
            </div>
            
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nivel de Estímulo</label>
                <select name="nivel_estimulo" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-2 border">
                    <option value="">Seleccione una clasificación...</option>
                    <option value="Bajo (Relajación)">Bajo (Relajación)</option>
                    <option value="Medio (Terapia Regular)">Medio (Terapia Regular)</option>
                    <option value="Alto (Estimulación Activa)">Alto (Estimulación Activa)</option>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition-colors shadow-md mt-2">
                Guardar Área
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-md lg:col-span-2 overflow-hidden border border-gray-200">
        <div class="bg-gray-50 p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="font-bold text-gray-700">Espacios Disponibles</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nombre del Área</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Nivel de Estímulo</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white text-sm">
                    @forelse($areas as $area)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $area->nombre_area }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold border 
                                {{ str_contains($area->nivel_estimulo, 'Bajo') ? 'bg-green-50 text-green-700 border-green-200' : 
                                  (str_contains($area->nivel_estimulo, 'Alto') ? 'bg-red-50 text-red-700 border-red-200' : 'bg-yellow-50 text-yellow-700 border-yellow-200') }}">
                                {{ $area->nivel_estimulo }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-3">
                                <a href="{{ route('areas.edit', $area->id) }}" 
                                   class="bg-amber-100 text-amber-700 hover:bg-amber-200 px-3 py-1 rounded-full text-xs font-bold uppercase border border-amber-200 transition-colors">
                                    Editar
                                </a>

                                <form action="{{ route('areas.destroy', $area->id) }}" method="POST" onsubmit="return confirm('¿Inhabilitar este espacio? Ya no aparecerá en la agenda de citas nuevas.');">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-xs uppercase pt-1 px-2">
                                        Inhabilitar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                            No hay consultorios registrados actualmente.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection