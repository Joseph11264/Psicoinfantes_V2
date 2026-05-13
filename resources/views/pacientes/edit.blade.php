@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200">
    <div class="mb-6 border-b pb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Editar Expediente de Paciente</h2>
        <a href="{{ route('pacientes.index') }}" class="text-gray-500 hover:text-gray-700 font-bold text-sm">Volver al listado</a>
    </div>

    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <h3 class="text-md font-bold text-blue-800 border-b pb-2 mb-4">Datos del Menor</h3>
            </div>
            
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase">Nombres</label>
                <input type="text" name="nombre_pac" value="{{ $paciente->nombre_pac }}" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase">Apellidos</label>
                <input type="text" name="apellido_pac" value="{{ $paciente->apellido_pac }}" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nac" value="{{ $paciente->fecha_nac }}" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="md:col-span-2 mt-4">
                <h3 class="text-md font-bold text-blue-800 border-b pb-2 mb-4">Datos del Representante Legal</h3>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase">Cédula de Identidad</label>
                <input type="text" name="ci_rep" value="{{ $paciente->ci_rep }}" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase">Nombre Completo</label>
                <input type="text" name="nombre_rep" value="{{ $paciente->nombre_rep }}" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase">Teléfono de Contacto</label>
                <input type="text" name="telefono_rep" value="{{ $paciente->telefono_rep }}" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-md transition-colors">
                Guardar Cambios del Expediente
            </button>
        </div>
    </form>
</div>
@endsection