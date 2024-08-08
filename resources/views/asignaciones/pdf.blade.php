<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formato de Entrega de Equipo | {{ $asignacion->empleado->nombre }} {{ $asignacion->empleado->apellidoP }}
        {{ $asignacion->empleado->apellidoM }}</title>
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
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            font-size: 10px;
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
        <h1 class="title">Formato de Entrega de Equipo</h1>
    </div>
    
    <div class="section">
        <table>
            <tr>
                <td><strong>Recibe:</strong>{{ $asignacion->empleado->nombre }}
                    {{ $asignacion->empleado->apellidoP }} {{ $asignacion->empleado->apellidoM }}</td>
                <td><strong>Fecha:</strong>{{ $asignacion->fecha_asignacion }}</td>
                <td><strong>Nomina:</strong> {{$asignacion->empleado->numero_nomina }}</td>
            </tr>
            <tr>
                <td><strong>Departamento:</strong> {{$asignacion->empleado->area }}</td>
                <td><strong>Cargo:</strong>{{$asignacion->empleado->puesto }}</td>
                <td><strong>Área/sección:</strong> {{$asignacion->empleado->area }}</td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <h3>Recibe el siguiente equipo</h3>
        <table>
            <tr>
                <th>Partida</th>
                <th>Artículo</th>
                <th>Cantidad</th>
                <th>Observaciones</th>
            </tr>
            <tr>
                <td>1</td>
                <td>{{ $asignacion->equipo->tipo }}</td>
                <td>1</td>
                <td>
                    Marca: {{ $asignacion->equipo->marca }}<br>
                    Modelo: {{ $asignacion->equipo->modelo }}<br>
                    Número de serie: {{ $asignacion->equipo->numero_serie }}<br>
                    Etiqueta Skytex: {{ $asignacion->equipo->etiqueta_skytex }}
                </td>
            </tr>
        </table>
    </div>
    
    <div class="section">
       <p> {{ $asignacion->nota_descriptiva }} </p>
    </div>
    
    <div class="section footer">
        <p>
            La(s) persona(s) que firman este documento declaran haber recibido los equipos y herramientas proporcionados por la empresa Skytex Mexico, S.A. de C.V.,
            descritos en la parte de arriba en buenas condiciones de funcionamiento, el(los) cual(es) se compromete a cuidarlos y utilizarlos correctamente de acuerdo a las
            actividades que se le han asignado. De la misma manera, la(s) persona(s) que firman este documento se hacen responsables de cualquier daño o pérdida del
            equipo entregado. En caso de daño o pérdida el departamento de Infraestructura de TI generará el debido reporte de incidencia que se entrega a Recursos
            Humanos para tomar las medidas o sanciones que apliquen al caso. Es importante precisar que el equipo de cómputo es de uso personal (a menos que se indique
            lo contrario en este formato) por lo cual la persona que firma esta hoja debe asegurarse del uso adecuado del mismo, no prestarlo sin supervisión, al levantarse del
            equipo debe bloquearse y mucho menos prestar las credenciales de acceso (usuario y contraseña). Cualquier actividad que comprometa la integridad del equipo,
            información y/o seguridad informática de la red de la empresa y será reportada a la Dirección de la empresa y departamento de Recursos Humanos quienes
            valoraran y aplicará las medidas y sanciones correspondientes al propietario del equipo.
        </p>
    </div>
    
    <div class="section">
        <div class="signatures">
            <div class="signature">
                <div class="signature-line"></div>
                <p>Víctor Méndez Hdez<br>Gerente de Infraestructura TI</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>{{ $asignacion->usuario->name }}<br>Entrega</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>{{ $asignacion->empleado->nombre }} {{ $asignacion->empleado->apellidoP }}
                    {{ $asignacion->empleado->apellidoM }}<br>Recibe</p>
            </div>
        </div>
    </div>
</body>
</html>