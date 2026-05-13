@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200">
    <div class="mb-6 border-b pb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Modificar Espacio Físico</h2>
        <a href="{{ route('areas.index') }}" class="text-gray-500 hover:text-gray-700 font-bold text-sm">Volver al listado</a>
    </div>

    <form action="{{ route('areas.update', $area->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nombre del Consultorio / Área</label>
            <input type="text" name="nombre_area" value="{{ $area->nombre_area }}" required 
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-sm border bg-gray-50">
        </div>
        
        <div>
            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nivel de Estímulo</label>
            <select name="nivel_estimulo" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-sm border bg-gray-50">
                <option value="Bajo (Relajación)" {{ str_contains($area->nivel_estimulo, 'Bajo') ? 'selected' : '' }}>Bajo (Relajación)</option>
                <option value="Medio (Terapia Regular)" {{ str_contains($area->nivel_estimulo, 'Medio') ? 'selected' : '' }}>Medio (Terapia Regular)</option>
                <option value="Alto (Estimulación Activa)" {{ str_contains($area->nivel_estimulo, 'Alto') ? 'selected' : '' }}>Alto (Estimulación Activa)</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-lg transition-colors shadow-md">
                Actualizar Datos del Área
            </button>
        </div>
    </form>
</div>
@endsection