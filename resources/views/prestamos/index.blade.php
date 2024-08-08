@extends('layouts.admin')

@section('titulo', 'Lista de Préstamos')

@section('contenido')

    <div>
        <a href="{{ route('prestamos.create') }}" class="btn btn-secondary mb-3">Crear Nuevo Préstamo +</a>
    </div>

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empleado</th>
                        <th>Equipo</th>
                        <th>Fecha de Préstamo</th>
                        <th>Fecha de Regreso</th>
                        <th>Responsable</th>
                        <th>Devuelto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prestamos as $prestamo)
                        <tr>
                            <td>{{ $prestamo->id }}</td>
                            <td>{{ $prestamo->empleado->nombre ?? 'N/A' }} {{ $prestamo->empleado->apellidoP ?? 'N/A' }} {{ $prestamo->empleado->apellidoM ?? 'N/A' }}</td>
                            <td>{{ $prestamo->equipo->numero_serie }}</td>
                            <td>{{ $prestamo->fecha_prestamo }}</td>
                            <td>{{ $prestamo->fecha_regreso }}</td>
                            <td>{{ $prestamo->usuario->name }}</td>
                            <td>{{ $prestamo->devuelto ? 'Sí' : 'No' }}</td>
                            <td>
                                <a href="{{ route('prestamos.show', $prestamo->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Está seguro de que desea eliminar este préstamo?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $prestamos->links() }}
        </div>
    </div>
@endsection
