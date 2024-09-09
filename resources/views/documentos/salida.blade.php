<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pase de Salida para Equipo de Cómputo | {{ $salida->empleado->nombre }}
        {{ $salida->empleado->apellidoP }} {{ $salida->empleado->apellidoM }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .logo {
            width: 150px;
            display: inline-block;
            vertical-align: middle;
        }

        .title {
            display: inline-block;
            vertical-align: middle;
            font-size: 18px;
            font-weight: bold;
            margin-left: 20px;
        }

        .section {
            border: 1px solid #ffffff;
            padding: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            font-size: 8px;
            text-align: justify;
        }

        .signatures {
            margin-top: 30px;
        }

        .signature {
            display: inline-block;
            width: 32%;
            text-align: center;
            vertical-align: top;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 40px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('libs/img/logo_skytex.png') }}" alt="Skytex Logo" class="logo">
        <h1 class="title">Pase de Salida para Equipo de Cómputo</h1>
        <p style="float: right; width: 10%">
            <font color="#ff0000 "> Folio: {{ $salida->id }}</font>
        </p>

    </div>

    <div class="section">
        <table>
            <tr>
                <td><strong>Nombre de empleado:</strong> {{ $salida->empleado->nombre }}
                    {{ $salida->empleado->apellidoP }} {{ $salida->empleado->apellidoM }}</td>
                <td><strong>Fecha:</strong> {{ $salida->fecha_salida }}</td>
            </tr>
            <tr>
                <td><strong>Nómina:</strong> {{ $salida->empleado->numero_nomina }}</td>
                <td><strong>Departamento:</strong> {{ $salida->empleado->area }}</td>
            </tr>
            <tr>
                <td><strong>Área:</strong> {{ $salida->empleado->area }}</td>
                <td>
                    <strong>SALE (X)</strong>
                </td>

            </tr>
        </table>
    </div>

    <div class="section">
        <table>
            <tr>
                <th>Partida</th>
                <th>Cantidad</th>
                <th>Descripción (Incluye modelo y/o etiqueta SKYTEX)</th>
                <th>Número de Serie</th>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>{{ $salida->equipo->tipoEquipo->nombre ?? 'Sin Tipo' }}
                    {{ $salida->equipo->marca->nombre ?? 'Sin Marca' }} {{ $salida->equipo->modelo }} Etq:
                    {{ $salida->equipo->etiqueta_skytex }}</td>
                <td>{{ $salida->equipo->numero_serie }}</td>
            </tr>
        </table>
    </div>
    <div class="section">
        <table>
            <tr>
                <td><strong>Nota de Salida:</strong> {{ $salida->nota_salida }}</td>
            </tr>
    </div>
    </table>

    <div class="section">
        <p><strong>Fecha de Salida:</strong> {{ $salida->fecha_salida }}</p>
        <p><strong>Fecha de Regreso:</strong> {{ $salida->fecha_regreso }}</p>
    </div>

    <div class="section">
        <div class="signatures">
            <div class="signature">
                <div class="signature-line"></div>
                <p>Víctor Méndez Hdez<br>Gerente de Infraestructura TI</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>{{ $salida->usuarioResponsable->name ?? 'N/A' }}<br>Autoriza</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>{{ $salida->empleado->nombre }} {{ $salida->empleado->apellidoP }}
                    {{ $salida->empleado->apellidoM }}<br>Recibe</p>
            </div>
        </div>
    </div>
    <div class="section footer">
        <p style="text-align: center">
            <strong> Este pase de salida solo es válido por 3 meses. Transcurrido este tiempo deberán tramitar uno
                nuevo.</strong>
        </p>
    </div>
</body>

</html>
