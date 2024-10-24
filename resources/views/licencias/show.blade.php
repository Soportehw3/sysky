@extends('layouts.admin')

@section('titulo', 'Detalle de la Licencia')

@section('contenido')

<div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
    <div class="card-body">        
        <table class="table table-striped">
            <tr>
                <th>Nombre</th>
                <td>{{ $licencias->nombre }}</td>
            </tr>
            <tr>
                <th>Tipo de Licencia</th>
                <td>{{ $licencias->tipoLicencia->nombre ?? 'Sin Tipo de Licencia' }}</td>
            </tr>
            <tr>
                <th>Fecha de Adquisición</th>
                <td>{{ $licencias->fecha_adquisicion }}</td>
            </tr>
            <tr>
                <th>Frecuencia de Pago</th>
                <td>{{ ucfirst($licencias->frecuencia_pago) }}</td>
            </tr>
            <tr>
                <th>Fecha del Próximo Pago</th>
                <td>{{ $licencias->fecha_siguiente_pago }}</td>
            </tr>
            <tr>
                <th>Recordatorio de Pago</th>
                <td>{{ $licencias->fecha_recordatorio }}</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>{{ ucfirst($licencias->estado) }}</td>
            </tr>
            <tr>
                <th>Observaciones</th>
                <td>{{ $licencias->observaciones }}</td>
            </tr>
        </table>

        <a href="{{ route('licencias.index') }}" class="btn btn-secondary">Regresar</a>
        <a href="{{ route('licencias.edit', $licencias->id) }}" class="btn btn-primary">Editar</a>

        <form hidden action="{{ route('licencias.destroy', $licencias->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta licencia?')">Eliminar</button>
        </form>
    </div>
</div>

@endsection
