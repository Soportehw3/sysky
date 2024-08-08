@extends('layouts.admin')

@section('titulo', 'Detalle de la Asignación de Equipo')

@section('contenido')

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
          
            <table class="table table-striped">
                <tr>
                    <th>ID:</th>
                    <td>{{ $asignacion->id }}</td>
                </tr>
                <tr>
                    <th>Empleado:</th>
                    <td>{{ $asignacion->empleado->nombre }}
                        {{ $asignacion->empleado->apellidoP }} {{ $asignacion->empleado->apellidoM }}</td>
                </tr>
                <tr>
                    <th>Equipo:</th>
                    <td>{{ $asignacion->equipo->numero_serie ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Fecha de Asignación:</th>
                    <td>{{ $asignacion->fecha_asignacion }}</td>
                </tr>
                <tr>
                    <th>Usuario Responsable:</th>
                    <td>{{ $asignacion->usuario->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Ticket:</th>
                    <td>{{ $asignacion->ticket }}</td>
                </tr>
                <tr>
                    <th>Nota Descriptiva:</th>
                    <td>{{ $asignacion->nota_descriptiva }}</td>
                </tr>
                <tr>
                    <th>Empresa:</th>
                    <td>{{ $asignacion->empresa->nombre ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Estado:</th>
                    <td>{{ $asignacion->estado }}</td>
                </tr>
            </table>

            <a href="{{ route('asignacionesequipos.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('asignacionesequipos.edit', $asignacion->id) }}" class="btn btn-primary">Editar</a>

            <form action="{{ route('asignacionesequipos.destroy', $asignacion->id) }}" method="POST"
                style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('¿Está seguro de que desea eliminar esta asignación?')">Eliminar</button>
            </form>
            
                <a href="{{ route('asignacionesequipos.pdf', $asignacion->id) }}" class="btn btn-success">Generar PDF</a>
            
        </div>
    </div>
@endsection
