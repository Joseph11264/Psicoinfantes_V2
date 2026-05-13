@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <div class="mb-6 border-b pb-4 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Agendar Nueva Cita</h2>
            <p class="text-gray-500 text-sm">Módulo Transaccional de Atención Clínica</p>
        </div>
        <a href="{{ route('citas.index') }}" class="text-blue-600 hover:underline font-semibold">← Volver al calendario</a>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
            <p class="font-bold">Error de validación</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
            <p class="font-bold">El sistema rechazó la transacción por los siguientes motivos:</p>
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('citas.store') }}" method="POST" onsubmit="return confirm('¿Confirma los datos ingresados para agendar esta cita?');">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Paciente</label>
                <select name="paciente_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border bg-gray-50">
                    <option value="">Seleccione un paciente...</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                            {{ $paciente->nombre_pac }} {{ $paciente->apellido_pac }} (Rep: {{ $paciente->nombre_rep }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Especialista Asignado</label>
                <select name="especialista_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border bg-gray-50">
                    <option value="">Seleccione el especialista...</option>
                    @foreach($especialistas as $esp)
                        <option value="{{ $esp->id }}" {{ old('especialista_id') == $esp->id ? 'selected' : '' }}>
                            {{ $esp->nombre_esp }} - {{ $esp->especialidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Área de Atención (Neuroarquitectura)</label>
                <select name="area_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border bg-gray-50">
                    <option value="">Seleccione el área física...</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                            {{ $area->nombre_area }} (Estímulo: {{ $area->nivel_estimulo }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha Programada</label>
                <input type="date" name="fecha_cita" required value="{{ old('fecha_cita') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border bg-gray-50">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Hora de Inicio</label>
                <input type="time" name="hora_cita" required value="{{ old('hora_cita') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border bg-gray-50">
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-lg flex items-center gap-2">
                Procesar Transacción
            </button>
        </div>
    </form>
</div>
@endsection