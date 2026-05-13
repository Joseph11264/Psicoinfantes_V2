@extends('layouts.app')

@section('content')
<div class="mb-8 border-b pb-4">
    <h2 class="text-3xl font-bold text-gray-800">Centro de Reportes y Estadísticas</h2>
    <p class="text-gray-500 text-sm mt-1">Módulo de generación de documentos en PDF para la toma de decisiones clínicas y administrativas.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    
    <div class="bg-white rounded-xl shadow-md border-t-4 border-blue-500 overflow-hidden">
        <div class="bg-blue-50 p-4 border-b border-gray-100">
            <h3 class="font-bold text-blue-800 text-lg">Nivel Operacional</h3>
            <p class="text-xs text-gray-500">Documentos del día a día</p>
        </div>
        <div class="p-4 space-y-3">
            <a href="{{ route('reportes.asistencia') }}" target="_blank" class="block w-full text-left px-4 py-3 bg-gray-50 hover:bg-blue-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 transition-colors">
                📄 1. Asistencia Diaria (Hoy)
            </a>
            <div class="block w-full text-left px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg text-sm font-semibold text-gray-500 cursor-not-allowed">
                📄 2. Ficha de Paciente (Desde tabla)
            </div>
            <div class="block w-full text-left px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg text-sm font-semibold text-gray-500 cursor-not-allowed">
                📄 3. Ticket de Cita (Desde tabla)
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md border-t-4 border-yellow-500 overflow-hidden">
        <div class="bg-yellow-50 p-4 border-b border-gray-100">
            <h3 class="font-bold text-yellow-800 text-lg">Nivel de Supervisión</h3>
            <p class="text-xs text-gray-500">Control y monitoreo a corto plazo</p>
        </div>
        <div class="p-4 space-y-3">
            <a href="{{ route('reportes.facturacion') }}" target="_blank" class="block w-full text-left px-4 py-3 bg-gray-50 hover:bg-yellow-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 transition-colors">
                📊 4. Control Facturación Diaria
            </a>
            <a href="{{ route('reportes.citas_especialista') }}" target="_blank" class="block w-full text-left px-4 py-3 bg-gray-50 hover:bg-yellow-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 transition-colors">
                👨‍⚕️ 5. Carga por Especialista
            </a>
            <a href="{{ route('reportes.uso_infraestructura') }}" target="_blank" class="block w-full text-left px-4 py-3 bg-gray-50 hover:bg-yellow-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 transition-colors">
                🏢 6. Uso de Infraestructura
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md border-t-4 border-green-500 overflow-hidden">
        <div class="bg-green-50 p-4 border-b border-gray-100">
            <h3 class="font-bold text-green-800 text-lg">Nivel Gerencial</h3>
            <p class="text-xs text-gray-500">Estadísticas para toma de decisiones</p>
        </div>
        <div class="p-4 space-y-3">
            <a href="{{ route('reportes.diagnosticos') }}" target="_blank" class="block w-full text-left px-4 py-3 bg-gray-50 hover:bg-green-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 transition-colors">
                📈 7. Estadísticas de Diagnósticos
            </a>
            <a href="{{ route('reportes.ingresos_mensuales') }}" target="_blank" class="block w-full text-left px-4 py-3 bg-gray-50 hover:bg-green-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 transition-colors">
                💰 8. Ingresos Mensuales
            </a>
            <a href="{{ route('reportes.rendimiento_terapeutas') }}" target="_blank" class="block w-full text-left px-4 py-3 bg-gray-50 hover:bg-green-50 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 transition-colors">
                🏆 9. Rendimiento de Terapeutas
            </a>
        </div>
    </div>

</div>
@endsection