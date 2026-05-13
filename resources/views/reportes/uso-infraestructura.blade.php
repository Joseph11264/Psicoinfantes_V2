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
    <div class="header"><h2>Reporte de Supervisión: Uso de Espacios (Neuroarquitectura)</h2></div>
    <table>
        <tr><th>Área / Consultorio</th><th>Nivel de Estímulo</th><th>Total de Ocupaciones</th></tr>
        @foreach($areas as $area)
        <tr>
            <td>{{ $area->nombre_area }}</td>
            <td>{{ $area->nivel_estimulo }}</td>
            <td><strong>{{ $area->citas_count }}</strong> veces utilizada</td>
        </tr>
        @endforeach
    </table>
</body>
</html>