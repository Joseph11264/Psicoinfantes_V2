@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200">
    <div class="mb-6 border-b pb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Editar Perfil del Especialista</h2>
        <a href="{{ route('especialistas.index') }}" class="text-gray-500 hover:text-gray-700 font-bold text-sm">Volver al listado</a>
    </div>

    <form action="{{ route('especialistas.update', $especialista->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo</label>
            <input type="text" name="nombre_esp" value="{{ $especialista->nombre_esp }}" required 
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
        </div>
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Especialidades (Puede marcar varias)</label>
            
            @php
                // Convertimos el texto guardado en la base de datos en un arreglo real para compararlo
                $guardadas = explode(', ', $especialista->especialidad);
            @endphp

            <div class="space-y-2 bg-gray-50 p-3 rounded-md border border-gray-200 text-sm">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="especialidad[]" value="Psicología Infantil" class="mr-2 rounded"
                    {{ in_array('Psicología Infantil', $guardadas) ? 'checked' : '' }}>
                    Psicología Infantil
                </label>
                
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="especialidad[]" value="Terapia del Lenguaje" class="mr-2 rounded"
                    {{ in_array('Terapia del Lenguaje', $guardadas) ? 'checked' : '' }}>
                    Terapia del Lenguaje
                </label>
                
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="especialidad[]" value="Psicopedagogía" class="mr-2 rounded"
                    {{ in_array('Psicopedagogía', $guardadas) ? 'checked' : '' }}>
                    Psicopedagogía
                </label>
                
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="especialidad[]" value="Terapia Ocupacional" class="mr-2 rounded"
                    {{ in_array('Terapia Ocupacional', $guardadas) ? 'checked' : '' }}>
                    Terapia Ocupacional
                </label>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Rol en el Sistema</label>
            <select name="rol_sistema" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border bg-gray-50">
                <option value="Psicologo" {{ $especialista->rol_sistema == 'Psicologo' ? 'selected' : '' }}>Psicólogo / Terapeuta</option>
                <option value="Director" {{ $especialista->rol_sistema == 'Director' ? 'selected' : '' }}>Director Clínico</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors shadow-md">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection