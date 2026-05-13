@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">{{ $paciente->nombre_pac }} {{ $paciente->apellido_pac }}</h2>
            <p class="text-sm text-gray-500 font-semibold tracking-wide">EXPEDIENTE CLÍNICO DIGITAL Nº {{ str_pad($paciente->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('reportes.ficha', $paciente->id) }}" target="_blank" class="bg-gray-800 text-white px-4 py-2 rounded-lg font-bold text-xs uppercase">Imprimir Ficha</a>
            <a href="{{ route('pacientes.index') }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg font-bold text-xs uppercase hover:bg-gray-200">Volver</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="space-y-6">
            
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-xs font-bold text-blue-800 uppercase border-b pb-2 mb-4 italic">Información de Contacto</h3>
                <div class="space-y-3 text-sm">
                    <p><span class="text-gray-400 block text-xs">Representante:</span> <strong class="text-gray-800">{{ $paciente->nombre_rep }}</strong></p>
                    <p><span class="text-gray-400 block text-xs">Cédula:</span> <strong class="text-gray-800">{{ $paciente->ci_rep }}</strong></p>
                    <p><span class="text-gray-400 block text-xs">Teléfono:</span> <strong class="text-gray-800">{{ $paciente->telefono_rep }}</strong></p>
                    <p><span class="text-gray-400 block text-xs">Fecha Nacimiento:</span> <strong class="text-gray-800">{{ \Carbon\Carbon::parse($paciente->fecha_nac)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($paciente->fecha_nac)->age }} años)</strong></p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-xs font-bold text-purple-800 uppercase border-b pb-2 mb-4">Vinculación / Referencia Externa</h3>
                
                <form action="{{ route('vinculaciones.store') }}" method="POST" class="space-y-3 mb-6">
                    @csrf
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                    <input type="text" name="nombre_institucion" placeholder="Nombre (Ej: Colegio San José)" required class="w-full text-xs rounded border-gray-300">
                    <input type="text" name="tipo_institucion" placeholder="Tipo (Ej: Escuela, Tribunal)" required class="w-full text-xs rounded border-gray-300">
                    <input type="date" name="fecha_vinculacion" required class="w-full text-xs rounded border-gray-300">
                    <button type="submit" class="w-full bg-purple-600 text-white text-xs font-bold py-2 rounded hover:bg-purple-700 transition-colors">Vincular Institución</button>
                </form>

                <div class="space-y-3">
                    @foreach($paciente->vinculaciones as $vinculo)
                        <div class="p-3 bg-purple-50 rounded-lg border border-purple-100">
                            <p class="text-xs font-bold text-purple-900">{{ $vinculo->nombre_institucion }}</p>
                            <p class="text-[10px] text-purple-600 uppercase">{{ $vinculo->tipo_institucion }} - {{ \Carbon\Carbon::parse($vinculo->fecha_vinculacion)->format('d/m/Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-blue-600 p-6 rounded-xl shadow-lg">
                <h3 class="text-white font-bold mb-4 flex items-center gap-2 uppercase text-sm">
                    <span>📝</span> Nueva Nota de Evolución
                </h3>
                <form action="{{ route('historias.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <select name="especialista_id" required class="rounded-lg border-none text-sm p-2 w-full shadow-inner">
                            <option value="">¿Quién atiende hoy?</option>
                            @foreach($especialistas as $esp)
                                <option value="{{ $esp->id }}">{{ $esp->nombre_esp }}</option>
                            @endforeach
                        </select>
                        <input type="date" name="fecha_sesion" value="{{ date('Y-m-d') }}" required class="rounded-lg border-none text-sm p-2 w-full shadow-inner">
                    </div>
                    
                    <textarea name="observaciones" rows="3" required placeholder="Describa el progreso, conducta y actividades de la sesión..." class="w-full rounded-lg border-none text-sm shadow-inner"></textarea>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-black px-6 py-2 rounded-full text-xs uppercase shadow-md transition-all">
                            Guardar Nota Clínica
                        </button>
                    </div>
                </form>
            </div>

            <div class="space-y-4">
                <h3 class="text-gray-400 font-bold text-xs uppercase tracking-widest px-2">Línea de Tiempo Médica</h3>
                
                @forelse($paciente->historias as $nota)
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs">
                                    HC
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $nota->especialista->nombre_esp }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">{{ \Carbon\Carbon::parse($nota->fecha_sesion)->format('d \d\e F, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed border-l-4 border-blue-100 pl-4">
                            {{ $nota->observaciones }}
                        </p>
                    </div>
                @empty
                    <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl py-12 text-center text-gray-400">
                        <p class="text-sm">No hay registros en la historia clínica de este niño aún.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection