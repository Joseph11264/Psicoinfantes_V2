@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $paciente->nombre_pac }} {{ $paciente->apellido_pac }}</h2>
            <p class="text-sm text-gray-500 font-medium">Expediente Clínico Digital #{{ $paciente->id }}</p>
        </div>
        <a href="{{ route('pacientes.index') }}" class="text-blue-600 hover:underline font-bold text-sm">← Volver al Listado</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="space-y-6">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-xs font-bold text-blue-800 uppercase tracking-wider border-b pb-2 mb-4">Información del Paciente</h3>
                <div class="space-y-2 text-sm">
                    <p><span class="text-gray-500">Representante:</span> <br><strong>{{ $paciente->nombre_rep }}</strong></p>
                    <p><span class="text-gray-500">Cédula Rep:</span> <strong>{{ $paciente->ci_rep }}</strong></p>
                    <p><span class="text-gray-500">Contacto:</span> <strong>{{ $paciente->telefono_rep }}</strong></p>
                    <p><span class="text-gray-500">Edad:</span> <strong>{{ \Carbon\Carbon::parse($paciente->fecha_nac)->age }} años</strong></p>
                </div>
            </div>

            </div>

        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h3 class="font-bold text-blue-900 mb-4 flex items-center gap-2">
                    📝 Registrar Nueva Nota de Evolución
                </h3>
                <form action="{{ route('historias.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase">Especialista que atiende</label>
                            <select name="especialista_id" required class="w-full mt-1 rounded-lg border-gray-300 text-sm">
                                <option value="">Seleccione al especialista...</option>
                                @foreach($especialistas as $esp)
                                    <option value="{{ $esp->id }}">{{ $esp->nombre_esp }} ({{ $esp->especialidad }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase">Fecha de la Sesión</label>
                            <input type="date" name="fecha_sesion" value="{{ date('Y-m-d') }}" required class="w-full mt-1 rounded-lg border-gray-300 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase">Observaciones y Desarrollo de la Terapia</label>
                        <textarea name="observaciones" rows="4" required placeholder="Describa los avances, conductas observadas y actividades realizadas..." class="w-full mt-1 rounded-lg border-gray-300 text-sm"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase">Diagnóstico Evolutivo / Sugerencias</label>
                        <input type="text" name="diagnostico_evolutivo" placeholder="Ej: Mejoría en contacto visual, requiere refuerzo en motricidad..." class="w-full mt-1 rounded-lg border-gray-300 text-sm">
                    </div>

                    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 rounded-lg transition-all shadow-md">
                        Guardar Nota en Historia Clínica
                    </button>
                </form>
            </div>

            <div class="space-y-4">
                <h3 class="font-bold text-gray-700 flex items-center gap-2 px-2">
                    📋 Historial de Sesiones
                </h3>
                @forelse($paciente->historias as $nota)
                    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1 h-full bg-blue-500"></div>
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <span class="text-xs font-bold text-blue-600 uppercase">{{ \Carbon\Carbon::parse($nota->fecha_sesion)->format('d/m/Y') }}</span>
                                <h4 class="font-bold text-gray-800">Atendido por: {{ $nota->especialista->nombre_esp }}</h4>
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed mb-3 italic">
                            "{{ $nota->observaciones }}"
                        </p>
                        @if($nota->diagnostico_evolutivo)
                            <div class="bg-gray-50 p-2 rounded border border-gray-100">
                                <p class="text-xs text-gray-600"><strong>Evolución:</strong> {{ $nota->diagnostico_evolutivo }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-10 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                        <p class="text-gray-400 text-sm">No hay registros previos en la historia clínica de este paciente.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection