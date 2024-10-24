@extends('layouts.admin')

@section('titulo', 'Detalles de la Salida de Equipo')

@section('contenido')
    <div class="container mt-6">

        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <strong>Detalles de la Salida - ID: {{ $salida->id }}</strong>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="card-title"><strong>Equipo:</strong> {{ $salida->equipo->etiqueta_skytex }}</h5>
                </div>
                <div class="mb-3">
                    <p class="card-text"><strong>Empleado:</strong> {{ $salida->empleado->nombre }}
                        {{ $salida->empleado->apellidoP }} {{ $salida->empleado->apellidoM }}</p>
                </div>
                <div class="mb-3">
                    <p class="card-text"><strong>Usuario Responsable:</strong> {{ $salida->usuarioResponsable->name }}</p>
                </div>
                <div class="mb-3">
                    <p class="card-text"><strong>Fecha de Salida:</strong> {{ $salida->fecha_salida }}</p>
                </div>
                <div class="mb-3">
                    <p class="card-text"><strong>Fecha de Regreso:</strong>
                        {{ $salida->fecha_regreso ?? 'No ha regresado' }}</p>
                </div>
                <div class="mb-3">
                    <p class="card-text"><strong>Nota de Salida:</strong> {{ $salida->nota_salida }}</p>
                </div>

                @if ($salida->imagen)
                    <div class="mb-4">
                        <p class="card-text"><strong>Imagen de la Salida:</strong></p>
                        <img src="{{ asset('images/salidas/' . $salida->imagen) }}" alt="Imagen de la salida"
                            class="img-fluid rounded shadow-sm">
                    </div>
                @endif

                <div class="mb-3">
                    <p class="card-text"><strong>Nota de Regreso:</strong>
                        {{ $salida->nota_regreso ?? 'No hay nota de regreso' }}</p>
                </div>

                @if ($salida->imagen_regreso)
                    <div class="mb-4">
                        <p class="card-text"><strong>Imagen del Regreso:</strong></p>
                        <img src="{{ asset('storage/' . $salida->imagen_regreso) }}" alt="Imagen del regreso"
                            class="img-fluid rounded shadow-sm">
                    </div>
                @endif
            </div>
            <div class="card-footer bg-light">
                <a href="{{ route('salidas.index') }}" class="btn btn-secondary">Volver a la Lista de Salidas</a>
            </div>
        </div>
    </div>
@endsection
