<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadística de Diagnósticos</title>
    <style>
        body { font-family: Helvetica, sans-serif; font-size: 13px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; background-color: #1e3a8a; color: white; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #e5e7eb; padding: 12px; border-bottom: 2px solid #9ca3af; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #e5e7eb; }
        .bar-container { width: 100%; background-color: #f3f4f6; border-radius: 4px; overflow: hidden; }
        .bar { height: 16px; background-color: #3b82f6; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin:0;">Reporte Gerencial: Incidencia de Patologías</h2>
        <p style="margin:5px 0 0 0;">Análisis estadístico para la toma de decisiones clínicas</p>
    </div>

    <p><strong>Total de diagnósticos registrados en el sistema:</strong> {{ $totalPacientes }}</p>

    <table>
        <thead>
            <tr>
                <th style="width: 40%">Patología / Condición</th>
                <th style="width: 15%; text-align: center;">Casos Totales</th>
                <th style="width: 15%; text-align: center;">Porcentaje</th>
                <th style="width: 30%">Representación Gráfica</th>
            </tr>
        </thead>
        <tbody>
            @forelse($diagnosticos as $diag)
                @php
                    $porcentaje = $totalPacientes > 0 ? round(($diag->total_casos / $totalPacientes) * 100, 1) : 0;
                @endphp
            <tr>
                <td style="font-weight: bold;">{{ $diag->patologia }}</td>
                <td style="text-align: center;">{{ $diag->total_casos }}</td>
                <td style="text-align: center;">{{ $porcentaje }}%</td>
                <td>
                    <div class="bar-container">
                        <div class="bar" style="width: {{ $porcentaje }}%;"></div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">No hay suficientes datos clínicos registrados para generar estadísticas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>