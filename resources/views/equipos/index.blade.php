@extends('layouts.admin')

@section('titulo', 'Lista de Equipos')

@section('contenido')

    <div>
        <a href="{{ route('equipos.create') }}" class="btn btn-secondary mb-3">Crear Nuevo Equipo +</a>
    </div>

    <!-- Barra de búsqueda -->
    <form action="{{ route('equipos.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                placeholder="Buscar por número de serie, marca, modelo, etc." value="{{ request('search') }}">
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
                            @foreach (['numero_serie' => 'Número de Serie', 'marca' => 'Marca', 'modelo' => 'Modelo', 'etiqueta_skytex' => 'Etiqueta Skytex', 'tipoEquipo' => 'Tipo', 'orden_compra' => 'Orden De Compra', 'requisicion' => 'Requisición', 'estado' => 'Estado'] as $field => $label)
                                <th>
                                    <a
                                        href="{{ route('equipos.index', ['sort' => $field, 'order' => $sortField === $field && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                        {{ $label }}
                                        @if ($sortField === $field)
                                            @if ($sortOrder === 'asc')
                                                &#9650;
                                            @else
                                                &#9660;
                                            @endif
                                        @endif
                                    </a>
                                </th>
                            @endforeach
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($equipos as $equipo)
                            <tr>
                                <td>{{ $equipo->numero_serie }}</td>
                                <td>{{ optional($equipo->marca)->nombre ?? '' }}</td>
                                <td>{{ $equipo->modelo }}</td>
                                <td>{{ $equipo->etiqueta_skytex }}</td>
                                <td>{{ optional($equipo->tipoEquipo)->nombre ?? '' }}</td>
                                <td>{{ $equipo->orden_compra }}</td>
                                <td>{{ $equipo->requisicion }}</td>
                                <td>

                                    <span
                                        class="badge rounded-pill 
                @if ($equipo->estado == 'No Asignado') badge-secondary
                @elseif ($equipo->estado == 'Asignado') badge-primary
                @elseif ($equipo->estado == 'Baja') badge-danger
                @else badge-default @endif">
                                        {{ $equipo->estado }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('equipos.show', $equipo->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('equipos.edit', $equipo->id) }}"
                                        class="btn btn-warning btn-sm">Editar</a>

                                    <form hidden action="{{ route('equipos.destroy', $equipo->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar este equipo?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No se encontraron equipos</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $equipos->appends(['search' => request('search'), 'sort' => $sortField, 'order' => $sortOrder])->links() }}
    </div>

@endsection
