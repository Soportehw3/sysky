@extends('layouts.admin')

@section('titulo', 'Lista de Equipos')

@section('contenido')
    <div>
        <a href="{{ route('equipos.create') }}" class="btn btn-secondary mb-3">Crear Nuevo Equipo +</a>
    </div>

    <!-- Barra de búsqueda -->
    <form action="{{ route('equipos.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por número de serie, marca, modelo, etc."
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
                                <a href="{{ route('equipos.index', ['sort' => 'numero_serie', 'order' => $sortField === 'numero_serie' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Número de Serie
                                    @if ($sortField === 'numero_serie')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('equipos.index', ['sort' => 'marca', 'order' => $sortField === 'marca' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Marca
                                    @if ($sortField === 'marca')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('equipos.index', ['sort' => 'modelo', 'order' => $sortField === 'modelo' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Modelo
                                    @if ($sortField === 'modelo')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('equipos.index', ['sort' => 'etiqueta_skytex', 'order' => $sortField === 'etiqueta_skytex' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Etiqueta Skytex
                                    @if ($sortField === 'etiqueta_skytex')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('equipos.index', ['sort' => 'tipo', 'order' => $sortField === 'tipo' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Tipo
                                    @if ($sortField === 'tipo')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('equipos.index', ['sort' => 'orden_compra', 'order' => $sortField === 'orden_compra' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Orden De Compra
                                    @if ($sortField === 'orden_compra')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('equipos.index', ['sort' => 'requisicion', 'order' => $sortField === 'requisicion' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Requisición
                                    @if ($sortField === 'requisicion')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('equipos.index', ['sort' => 'estado', 'order' => $sortField === 'estado' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Estado
                                    @if ($sortField === 'estado')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($equipos as $equipo)
                            <tr>
                                <td>{{ $equipo->numero_serie }}</td>
                                <td>{{ $equipo->marca }}</td>
                                <td>{{ $equipo->modelo }}</td>
                                <td>{{ $equipo->etiqueta_skytex }}</td>
                                <td>{{ $equipo->tipo }}</td>
                                <td>{{ $equipo->orden_compra }}</td>
                                <td>{{ $equipo->requisicion }}</td>
                                <td>{{ $equipo->estado }}</td>
                                <td>
                                    <a href="{{ route('equipos.show', $equipo->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este equipo?')">Eliminar</button>
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
