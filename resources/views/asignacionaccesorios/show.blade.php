@extends('layouts.admin')

@section('titulo', 'Detalle de la asignacion de accesorio')

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
                    <td>{{ $asignacion->empleado->nombre }}</td>
                </tr>
                <tr>
                    <th>Accesorio:</th>
                    <td>{{ $asignacion->accesorio->descripcion }}</td>
                </tr>
                <tr>
                    <th>Cantidad Asignada:</th>
                    <td>{{ $asignacion->cantidad_asignada }}</td>
                </tr>
                <tr>
                    <th>Fecha de Asignación:</th>
                    <td>{{ $asignacion->fecha_asignacion }}</td>
                </tr>
                <tr>
                    <th>Usuario Responsable:</th>
                    <td>{{ $asignacion->usuario->name }}</td>
                </tr>
                <tr>
                    <th>Ticket:</th>
                    <td>{{ $asignacion->ticket }}</td>
                </tr>
                <tr>
                    <th>Nota Descriptiva:</th>
                    <td>{{ $asignacion->nota_descriptiva }}</td>
                </tr>
            </table>

            <a href="{{ route('asignacionaccesorios.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('asignacionaccesorios.edit', $asignacion->id) }}" class="btn btn-primary">Editar</a>

            <form action="{{ route('asignacionaccesorios.destroy', $asignacion->id) }}" method="POST"
                style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('¿Está seguro de que desea eliminar este accesorio?')">Eliminar</button>
            </form>
        </div>
    </div>
@endsection
