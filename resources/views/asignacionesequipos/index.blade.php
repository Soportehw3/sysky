@extends('layouts.admin')

@section('titulo', 'Lista de Asignaciones de Equipos')

@section('contenido')
    <div>
        <a href="{{ route('asignacionesequipos.create') }}" class="btn btn-secondary mb-3">Registrar Nueva Asignación +</a>
        <a href="https://drive.google.com/drive/folders/19tknKByTY52YGtjIVrjk9Pr7sndunRib" class="btn btn-success mb-3" target="_blank">Subir formato de asignacion</a>
    </div>

    <!-- Barra de búsqueda -->
    <form method="GET" action="{{ route('asignacionesequipos.index') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" value="{{ request()->search }}"
                placeholder="Buscar por empleado, equipo, fecha, ticket o estado">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><a
                                    href="{{ route('asignacionesequipos.index', ['sort' => 'empleado', 'order' => $sortField === 'empleado' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Empleado</a>
                            </th>
                            <th><a
                                    href="{{ route('asignacionesequipos.index', ['sort' => 'equipo', 'order' => $sortField === 'equipo' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Equipo</a>
                            </th>
                            <th>Equipo</th>
                            <th><a
                                    href="{{ route('asignacionesequipos.index', ['sort' => 'fecha_asignacion', 'order' => $sortField === 'fecha_asignacion' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Fecha
                                    de Asignación</a></th>
                            <th>Usuario Responsable</th>
                            <th><a
                                    href="{{ route('asignacionesequipos.index', ['sort' => 'ticket', 'order' => $sortField === 'ticket' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Ticket</a>
                            </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignacionesequipos as $asignacion)
                            <tr>
                                <td>{{ $asignacion->empleado->nombre ?? 'N/A' }}
                                    {{ $asignacion->empleado->apellidoP ?? 'N/A' }}
                                    {{ $asignacion->empleado->apellidoM ?? 'N/A' }}</td>
                                <td>{{ $asignacion->equipo->etiqueta_skytex ?? 'N/A' }}</td>
                                <td>{{ $asignacion->equipo->tipoEquipo->nombre ?? 'Sin Tipo' }}</td>
                                <td>{{ $asignacion->fecha_asignacion }}</td>
                                <td>{{ $asignacion->usuario->name ?? 'N/A' }}</td>
                                <td>{{ $asignacion->ticket }}</td>
                                <td>
                                    <a href="{{ route('asignacionesequipos.show', $asignacion->id) }}"
                                        class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('asignacionesequipos.edit', $asignacion->id) }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    <a href="{{ route('asignacionesequipos.pdf', $asignacion->id) }}"
                                        class="btn btn-primary btn-sm" target="_blank">Ver PDF</a>
                                    <form hidden type action="{{ route('asignacionesequipos.destroy', $asignacion->id) }}"
                                        method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="hidden" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar esta asignación?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $asignacionesequipos->appends(['search' => request()->search, 'sort' => request()->sort, 'order' => request()->order])->links() }}
    </div>
@endsection
