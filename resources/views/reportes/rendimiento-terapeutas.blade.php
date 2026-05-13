<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 13px; }
        .header { text-align: center; border-bottom: 2px solid #22c55e; padding-bottom: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #bbf7d0; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="header"><h2>Reporte Gerencial: Rendimiento y Eficacia de Terapeutas</h2></div>
    <p style="color: #555; text-align: center; margin-bottom: 20px;">Mide la cantidad de citas que el especialista logró llevar a estado "Facturada".</p>
    <table>
        <tr><th>Especialista</th><th>Rol</th><th>Terapias Concretadas (Pagadas)</th></tr>
        @foreach($rendimiento as $esp)
        <tr>
            <td>{{ $esp->nombre_esp }}</td>
            <td>{{ $esp->rol_sistema }}</td>
            <td><strong>{{ $esp->citas_completadas }}</strong> terapias exitosas</td>
        </tr>
        @endforeach
    </table>
</body>
</html>