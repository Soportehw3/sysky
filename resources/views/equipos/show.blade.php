@extends('layouts.admin')

@section('titulo', 'Detalle del Equipo')

@section('contenido')

<div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
    <div class="card-body">        
        <table class="table table-striped">
            <tr>
                <th>Número de Serie</th>
                <td>{{ $equipo->numero_serie }}</td>
            </tr>
            <tr>
                <th>Marca</th>
                <td>{{ $equipo->marca }}</td>
            </tr>
            <tr>
                <th>Modelo</th>
                <td>{{ $equipo->modelo }}</td>
            </tr>
            <tr>
                <th>Etiqueta Skytex</th>
                <td>{{ $equipo->etiqueta_skytex }}</td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td>{{ $equipo->tipo }}</td>
            </tr>
            <tr>
                <th>Orden de Compra</th>
                <td>{{ $equipo->orden_compra }}</td>
            </tr>
            <tr>
                <th>Requisición</th>
                <td>{{ $equipo->requisicion }}</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>{{ $equipo->estado }}</td>
            </tr>
        </table>

        <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Volver a la lista</a>
        <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-primary">Editar</a>

        <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este equipo?')">Eliminar</button>
        </form>
    </div>
</div>

@endsection
