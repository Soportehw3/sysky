@extends('layouts.admin')

@section('titulo', 'Equipos Dados de Baja')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <h4>Equipos con estado Baja</h4>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Número de Serie</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Etiqueta Skytex</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipos as $equipo)
                        <tr>
                            <td>{{ $equipo->id }}</td>
                            <td>{{ $equipo->numero_serie }}</td>
                            <td>{{ optional($equipo->marca)->nombre ?? '' }}</td>
                            <td>{{ $equipo->modelo }}</td>
                            <td>{{ $equipo->etiqueta_skytex }}</td>
                            <td>{{ optional($equipo->tipoEquipo)->nombre ?? '' }}</td>
                            <td>{{ $equipo->estado }}</td>
                            <td>
                                <a href="{{ route('equipos.show', $equipo->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-warning">Editar</a>
                                <form hidden action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este equipo?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $equipos->links() }}
        </div>
    </div>
@endsection
