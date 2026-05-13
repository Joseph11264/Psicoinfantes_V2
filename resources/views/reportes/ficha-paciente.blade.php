<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; border-bottom: 2px solid #3b82f6; padding-bottom: 10px; }
        .info-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .info-table td { padding: 8px; border: 1px solid #eee; }
        .label { font-weight: bold; background-color: #f3f4f6; width: 30%; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Clínica Psicoinfantes</h2>
        <p>Ficha de Admisión del Paciente</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nombre del Paciente:</td>
            <td>{{ $paciente->nombre_pac }} {{ $paciente->apellido_pac }}</td>
        </tr>
        <tr>
            <td class="label">Cédula Representante:</td>
            <td>{{ $paciente->ci_rep }}</td>
        </tr>
        <tr>
            <td class="label">Fecha de Nacimiento:</td>
            <td>{{ $paciente->fecha_nac }}</td>
        </tr>
    </table>
</body>
</html>