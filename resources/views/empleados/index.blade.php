@extends('layouts.admin')

@section('titulo', 'Lista de Empleados')

@section('contenido')
    <div>
        <a href="{{ route('empleados.create') }}" class="btn btn-secondary mb-3">Crear Nuevo Empleado +</a>
    </div>

    <!-- Barra de búsqueda -->
    <form action="{{ route('empleados.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por número de nómina o nombre"
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
                                <a
                                    href="{{ route('empleados.index', ['sort' => 'numero_nomina', 'order' => $sortField === 'numero_nomina' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Número de Nómina
                                    @if ($sortField === 'numero_nomina')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ route('empleados.index', ['sort' => 'nombre', 'order' => $sortField === 'nombre' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
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
                                <a
                                    href="{{ route('empleados.index', ['sort' => 'puesto', 'order' => $sortField === 'puesto' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Puesto
                                    @if ($sortField === 'puesto')
                                        @if ($sortOrder === 'asc')
                                            &#9650;
                                        @else
                                            &#9660;
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ route('empleados.index', ['sort' => 'area', 'order' => $sortField === 'area' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Área
                                    @if ($sortField === 'area')
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
                        @forelse ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->numero_nomina }}</td>
                                <td>{{ $empleado->nombre }}</td>
                                <td>{{ $empleado->puesto }}</td>
                                <td>{{ $empleado->area }}</td>
                                <td>
                                    <a href="{{ route('empleados.show', $empleado->id) }}"
                                        class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('empleados.edit', $empleado->id) }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar este empleado?')">Eliminar</button>

                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No se encontraron empleados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $empleados->appends(['search' => request('search'), 'sort' => $sortField, 'order' => $sortOrder])->links() }}
    </div>
@endsection
