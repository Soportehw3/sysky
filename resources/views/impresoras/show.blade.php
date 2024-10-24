@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Impresora</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Modelo: {{ $impresora->modelo }}</h5>
            <p class="card-text"><strong>Marca:</strong> {{ $impresora->marca }}</p>
            <p class="card-text"><strong>Área:</strong> {{ $impresora->area }}</p>
            <p class="card-text"><strong>Dirección IP:</strong> {{ $impresora->ip }}</p>

            <!-- Estado con color dinámico -->
            <p class="card-text">
                <strong>Estado:</strong> 
                <span 
                    class="badge 
                        {{ $impresora->estado === 'En línea' ? 'bg-success' : 'bg-danger' }}">
                    {{ $impresora->estado }}
                </span>
            </p>

            <a href="{{ route('impresoras.edit', $impresora->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('impresoras.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
