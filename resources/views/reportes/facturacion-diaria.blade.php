<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cierre de Facturación</title>
    <style>
        body { font-family: Helvetica, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #10b981; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #f3f4f6; padding: 8px; border: 1px solid #ddd; text-align: left; }
        td { padding: 8px; border: 1px solid #ddd; }
        .totales { margin-top: 20px; width: 40%; float: right; background-color: #f8fafc; padding: 15px; border: 1px solid #cbd5e1; }
        .totales-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .total-final { font-size: 16px; font-weight: bold; color: #047857; margin-top: 10px; border-top: 2px solid #047857; padding-top: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin:0; color: #047857;">Reporte de Supervisión Financiera</h2>
        <p style="margin:5px 0;">Cierre de Facturación Diario | Fecha: {{ \Carbon\Carbon::parse($hoy)->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nº Factura</th>
                <th>Paciente</th>
                <th>Subtotal</th>
                <th>IVA (16%)</th>
                <th>Total Pagado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($facturas as $factura)
            <tr>
                <td>#00{{ $factura->id }}</td>
                <td>{{ $factura->cita->paciente->nombre_pac }} {{ $factura->cita->paciente->apellido_pac }}</td>
                <td>${{ number_format($factura->subtotal, 2) }}</td>
                <td>${{ number_format($factura->impuesto_iva, 2) }}</td>
                <td><strong>${{ number_format($factura->monto_total, 2) }}</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">No hay facturas procesadas en esta fecha.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="totales">
        <div class="totales-row"><span>Total Base Imponible:</span> <span>${{ number_format($totalSubtotal, 2) }}</span></div>
        <div class="totales-row"><span>Total IVA Retenido:</span> <span>${{ number_format($totalIva, 2) }}</span></div>
        <div class="totales-row total-final"><span>Ingreso Bruto Total:</span> <span>${{ number_format($totalRecaudado, 2) }}</span></div>
    </div>
</body>
</html>