@extends('layouts.admin')

@section('titulo', 'Lista de Licencias')

@section('contenido')
    <div>
        <a href="{{ route('licencias.create') }}" class="btn btn-secondary mb-3">Registrar Nueva Licencia +</a>
    </div>
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <!-- Barra de búsqueda -->
            <form method="GET" action="{{ route('licencias.index') }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" value="{{ request()->search }}"
                        placeholder="Buscar por nombre, tipo o usuario responsable">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de licencias -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('licencias.index', ['sort' => 'nombre', 'order' => $sortField === 'nombre' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Nombre
                                @if ($sortField === 'nombre')
                                    @if ($sortOrder === 'asc')
                                        &#9650;
                                    @else
                                        &#9660;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('licencias.index', ['sort' => 'tipo_licencia_id', 'order' => $sortField === 'tipo_licencia_id' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Tipo
                                @if ($sortField === 'tipo_licencia_id')
                                    @if ($sortOrder === 'asc')
                                        &#9650;
                                    @else
                                        &#9660;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>Fecha de Adquisición</th>
                        <th>Frecuencia de Pago</th>
                        <th>Próximo Pago</th>
                        <th>Estado</th>
                        <th>Usuario Responsable</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($licencias as $licencia)
                        <tr>
                            <td>{{ $licencia->nombre }}</td>
                            <td>{{ $licencia->tipoLicencia->nombre ?? 'Sin Tipo' }}</td>
                            <td>{{ $licencia->fecha_adquisicion }}</td>
                            <td>{{ ucfirst($licencia->frecuencia_pago) }}</td>
                            <td>{{ $licencia->fecha_siguiente_pago }}</td>
                            <td>{{ ucfirst($licencia->estado) }}</td>
                            <td>{{ $licencia->usuario->name ?? 'No Asignado' }}</td>
                            <td>
                                <a href="{{ route('licencias.show', $licencia->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('licencias.edit', $licencia->id) }}" class="btn btn-warning">Editar</a>
                                <form hidden action="{{ route('licencias.destroy', $licencia->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta licencia?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="d-flex justify-content-center">
                {{ $licencias->appends(['search' => request()->search, 'sort' => $sortField, 'order' => $sortOrder])->links() }}
            </div>
        </div>
    </div>
@endsection
