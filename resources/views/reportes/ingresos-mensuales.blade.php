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
    <div class="header"><h2>Reporte Gerencial: Resumen Histórico de Ingresos</h2></div>
    <table>
        <tr><th style="text-transform: capitalize;">Período Mensual</th><th>Transacciones (Citas Pagadas)</th><th>Ingreso Total Bruto</th></tr>
        @foreach($meses as $mes => $datos)
        <tr>
            <td style="text-transform: capitalize;">{{ $mes }}</td>
            <td>{{ $datos['cantidad_facturas'] }} transacciones</td>
            <td><strong>${{ number_format($datos['total_recaudado'], 2) }}</strong></td>
        </tr>
        @endforeach
    </table>
</body>
</html>