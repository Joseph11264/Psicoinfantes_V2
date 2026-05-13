<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Cita</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; font-size: 14px; color: #000; }
        .ticket-container { border: 2px dashed #333; padding: 20px; max-width: 500px; margin: 0 auto; }
        .text-center { text-align: center; }
        .divider { border-bottom: 1px dashed #333; margin: 15px 0; }
        .data-row { margin-bottom: 8px; }
        .label { font-weight: bold; display: inline-block; width: 120px; }
    </style>
</head>
<body>
    <div class="ticket-container">
        <h2 class="text-center" style="margin-bottom: 5px;">CLÍNICA PSICOINFANTES</h2>
        <p class="text-center" style="margin-top: 0; font-size: 12px;">Comprobante de Admisión</p>
        
        <div class="divider"></div>
        
        <div class="data-row"><span class="label">TICKET Nº:</span> 00{{ $cita->id }}</div>
        <div class="data-row"><span class="label">FECHA:</span> {{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</div>
        <div class="data-row"><span class="label">HORA:</span> {{ \Carbon\Carbon::parse($cita->hora_cita)->format('h:i A') }}</div>
        
        <div class="divider"></div>
        
        <div class="data-row"><span class="label">PACIENTE:</span> {{ $cita->paciente->nombre_pac }} {{ $cita->paciente->apellido_pac }}</div>
        <div class="data-row"><span class="label">ESPECIALISTA:</span> {{ $cita->especialista->nombre_esp }}</div>
        <div class="data-row"><span class="label">ÁREA:</span> {{ $cita->area->nombre_area }}</div>
        
        <div class="divider"></div>
        
        <p class="text-center" style="font-size: 10px; margin-top: 20px;">
            Este documento es válido como comprobante de asignación de turno.<br>
            Por favor, preséntelo en recepción.
        </p>
    </div>
</body>
</html>