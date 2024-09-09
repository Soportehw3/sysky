@extends('layouts.admin')

@section('titulo', 'Salidas de equipo')

@section('contenido')

<div>
    <a href="{{ route('salidas.create') }}" class="btn btn-secondary mb-3">Registrar Nueva Salida</a>
</div>

<!-- Barra de búsqueda -->
<div class="mb-3">
    <form action="{{ route('salidas.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por equipo o empleado..." class="form-control">
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipo</th>
                        <th>Empleado</th>
                        <th>Fecha de Salida</th>
                        <th>Fecha de Regreso</th>
                        <th>Usuario Responsable</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salidas as $salida)
                        <tr>
                            <td>{{ $salida->id }}</td>
                            <td>{{ $salida->equipo->etiqueta_skytex }}</td>
                            <td>{{ $salida->empleado->nombre }} {{ $salida->empleado->apellidoP }} {{ $salida->empleado->apellidoM }}</td>
                            <td>{{ $salida->fecha_salida }}</td>
                            <td>{{ $salida->fecha_regreso ?? 'No ha regresado' }}</td>
                            <td>{{ $salida->usuarioResponsable->name }}</td>
                            <td>
                                @if ($salida->imagen)
                                    <img src="{{ asset('images/salidas/' . $salida->imagen) }}" alt="Imagen de Salida" width="100">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('salidas.show', $salida->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                                <a href="{{ route('salidas.edit', array_merge(['salida' => $salida->id], request()->query())) }}" class="btn btn-warning btn-sm">Registrar Regreso</a>
                                <a href="{{ route('ruta.generarPDF', $salida->id) }}" class="btn btn-primary btn-sm" target="_blank">Ver PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $salidas->links() }}
        </div>
    </div>
</div>
@endsection
