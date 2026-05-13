<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencia Diaria</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #1e3a8a; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f3f4f6; color: #333; font-weight: bold; padding: 10px; border: 1px solid #ddd; text-align: left; }
        td { padding: 10px; border: 1px solid #ddd; }
        .badge { background-color: #e5e7eb; padding: 3px 8px; border-radius: 10px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Clínica Psicoinfantes</h1>
        <h2>Reporte Operativo: Control de Asistencia Diaria</h2>
        <p>Fecha de Operación: {{ \Carbon\Carbon::parse($hoy)->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Hora</th>
                <th>Paciente</th>
                <th>Representante</th>
                <th>Especialista Asignado</th>
                <th>Área (Neuroarquitectura)</th>
                <th>Firma de Asistencia</th>
            </tr>
        </thead>
        <tbody>
            @forelse($citas as $cita)
            <tr>
                <td><strong>{{ \Carbon\Carbon::parse($cita->hora_cita)->format('h:i A') }}</strong></td>
                <td>{{ $cita->paciente->nombre_pac }} {{ $cita->paciente->apellido_pac }}</td>
                <td>{{ $cita->paciente->nombre_rep }}<br><span class="badge">{{ $cita->paciente->ci_rep }}</span></td>
                <td>{{ $cita->especialista->nombre_esp }}</td>
                <td>{{ $cita->area->nombre_area }}</td>
                <td></td> </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">No hay citas programadas para el día de hoy.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>