<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 13px; }
        .header { text-align: center; border-bottom: 2px solid #eab308; padding-bottom: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #fef08a; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="header"><h2>Reporte de Supervisión: Carga por Especialista</h2></div>
    <table>
        <tr><th>Especialista</th><th>Especialidad</th><th>Citas Asignadas (Histórico)</th></tr>
        @foreach($especialistas as $esp)
        <tr>
            <td>{{ $esp->nombre_esp }}</td>
            <td>{{ $esp->especialidad }}</td>
            <td><strong>{{ $esp->citas_count }}</strong> turno(s)</td>
        </tr>
        @endforeach
    </table>
</body>
</html>