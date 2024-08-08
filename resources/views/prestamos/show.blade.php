@extends('layouts.admin')

@section('titulo', 'Detalle del Préstamo')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>ID:</th>
                    <td>{{ $prestamo->id }}</td>
                </tr>
                <tr>
                    <th>Empleado:</th>
                    <td>{{ $prestamo->empleado->nombre ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Equipo:</th>
                    <td>{{ $prestamo->equipo->numero_serie ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Fecha de Préstamo:</th>
                    <td>{{ $prestamo->fecha_prestamo }}</td>
                </tr>
                <tr>
                    <th>Fecha de Regreso:</th>
                    <td>{{ $prestamo->fecha_regreso }}</td>
                </tr>
                <tr>
                    <th>Usuario Responsable:</th>
                    <td>{{ $prestamo->usuario->name }}</td>
                </tr>
                <tr>
                    <th>Devuelto:</th>
                    <td>{{ $prestamo->devuelto ? 'Sí' : 'No' }}</td>
                </tr>
            </table>
            <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este préstamo?')">Eliminar</button>
            </form>
        </div>
    </div>
@endsection
