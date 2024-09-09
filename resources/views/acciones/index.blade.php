@extends('layouts.admin')

@section('titulo', 'Acciones Registradas')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <!-- Barra de búsqueda -->
            <form action="{{ route('acciones.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por módulo, descripción o usuario..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Módulo</th>
                        <th>Descripción</th>
                        <th>Usuario Responsable</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($acciones as $accion)
                        <tr>
                            <td>{{ $accion->modulo }}</td>
                            <td>{{ $accion->descripcion }}</td>
                            <td>{{ $accion->usuario->name ?? 'N/A' }}</td>
                            <td>{{ $accion->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Enlaces de paginación -->
            {{ $acciones->appends(['search' => request('search')])->links() }}
        </div>
    </div>
@endsection
