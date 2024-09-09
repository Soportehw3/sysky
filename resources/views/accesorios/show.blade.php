@extends('layouts.admin')

@section('titulo', 'Detalle del Accesorio')

@section('contenido')

<div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
    <div class="card-body">        
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <td>{{ $accesorio->id }}</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>{{ $accesorio->descripcion }}</td>
            </tr>
            <tr>
                <th>Marca</th>
                <td>{{ $accesorio->marcaAccesorio->nombre ?? 'Sin Marca' }}</td>
            </tr>
            <tr>
                <th>Modelo</th>
                <td>{{ $accesorio->modelo }}</td>
            </tr>
            <tr>
                <th>Cantidad</th>
                <td>{{ $accesorio->cantidad }}</td>
            </tr>
            <tr>
                <th>Orden de Compra</th>
                <td>{{ $accesorio->orden_compra_acc }}</td>
            </tr>
            <tr>
                <th>Requisición</th>
                <td>{{ $accesorio->requisicion }}</td>
            </tr>
        </table>

        <a href="{{ route('accesorios.index') }}" class="btn btn-secondary">Volver a la lista</a>
        <a href="{{ route('accesorios.edit', $accesorio->id) }}" class="btn btn-primary">Editar</a>

        <form hidden action="{{ route('accesorios.destroy', $accesorio->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este accesorio?')">Eliminar</button>
        </form>
    </div>
</div>

@endsection
