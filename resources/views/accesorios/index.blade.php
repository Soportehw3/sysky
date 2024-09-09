@extends('layouts.admin')

@section('titulo', 'Lista de Accesorios')

@section('contenido')
    <div>
        <a href="{{ route('accesorios.create') }}" class="btn btn-secondary mb-3">Crear Nuevo Accesorio +</a>
    </div>
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <!-- Barra de búsqueda -->
            <form method="GET" action="{{ route('accesorios.index') }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" value="{{ request()->search }}"
                        placeholder="Buscar por descripción, marca o modelo">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de accesorios -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('accesorios.index', ['sort' => 'descripcion', 'order' => $sortField === 'descripcion' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Descripción
                                @if ($sortField === 'descripcion')
                                    @if ($sortOrder === 'asc')
                                        &#9650;
                                    @else
                                        &#9660;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('accesorios.index', ['sort' => 'marca_id', 'order' => $sortField === 'marca_id' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Marca
                                @if ($sortField === 'marca_id')
                                    @if ($sortOrder === 'asc')
                                        &#9650;
                                    @else
                                        &#9660;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('accesorios.index', ['sort' => 'modelo', 'order' => $sortField === 'modelo' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
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
                        <th>Cantidad</th>
                        <th>Orden de Compra</th>
                        <th>Requisición</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accesorios as $accesorio)
                        <tr>
                            <td>{{ $accesorio->descripcion }}</td>
                            <td>{{ $accesorio->marcaAccesorio->nombre ?? 'Sin Marca' }}</td>
                            <td>{{ $accesorio->modelo }}</td>
                            <td>{{ $accesorio->cantidad }}</td>
                            <td>{{ $accesorio->orden_compra_acc }}</td>
                            <td>{{ $accesorio->requisicion }}</td>
                            <td>
                                <a href="{{ route('accesorios.show', $accesorio->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('accesorios.edit', $accesorio->id) }}" class="btn btn-warning">Editar</a>
                                <form hidden action="{{ route('accesorios.destroy', $accesorio->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este accesorio?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="d-flex justify-content-center">
                {{ $accesorios->appends(['search' => request()->search, 'sort' => $sortField, 'order' => $sortOrder])->links() }}
            </div>
        </div>
    </div>
@endsection
