@extends('layouts.admin')

@section('titulo', 'Lista de Asignaciones de Accesorios')

@section('contenido')
    <div>
        <a href="{{ route('asignacionaccesorios.create') }}" class="btn btn-secondary mb-3">Crear Nueva Asignación +</a>
    </div>

    <form action="{{ route('asignacionaccesorios.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por Empleado, Accesorio, Fecha o Ticket"
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ route('asignacionaccesorios.index', ['sort' => 'id', 'order' => $sortField === 'id' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    ID
                                    @if ($sortField === 'id')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('asignacionaccesorios.index', ['sort' => 'empleado_id', 'order' => $sortField === 'empleado_id' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Empleado
                                    @if ($sortField === 'empleado_id')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('asignacionaccesorios.index', ['sort' => 'accesorio_id', 'order' => $sortField === 'accesorio_id' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Accesorio
                                    @if ($sortField === 'accesorio_id')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>Cantidad Asignada</th>
                            <th>
                                <a href="{{ route('asignacionaccesorios.index', ['sort' => 'fecha_asignacion', 'order' => $sortField === 'fecha_asignacion' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Fecha de Asignación
                                    @if ($sortField === 'fecha_asignacion')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>Usuario Responsable</th>
                            <th>
                                <a href="{{ route('asignacionaccesorios.index', ['sort' => 'ticket', 'order' => $sortField === 'ticket' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Ticket
                                    @if ($sortField === 'ticket')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>Nota Descriptiva</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignacionesaccesorios as $asignacion)
                            <tr>
                                <td>{{ $asignacion->id }}</td>
                                <td>{{ $asignacion->empleado->nombre }}</td>
                                <td>{{ $asignacion->accesorio->descripcion }}</td>
                                <td>{{ $asignacion->cantidad_asignada }}</td>
                                <td>{{ $asignacion->fecha_asignacion }}</td>
                                <td>{{ $asignacion->usuario->name }}</td>
                                <td>{{ $asignacion->ticket }}</td>
                                <td>{{ $asignacion->nota_descriptiva }}</td>
                                <td>
                                    <a href="{{ route('asignacionaccesorios.show', $asignacion->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('asignacionaccesorios.edit', $asignacion->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('asignacionaccesorios.destroy', $asignacion->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta asignación?')">Eliminar</button>
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
        {{ $asignacionesaccesorios->appends(['search' => $search, 'sort' => $sortField, 'order' => $sortOrder])->links() }}
    </div>
@endsection
