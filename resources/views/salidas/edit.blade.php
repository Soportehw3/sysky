@extends('layouts.admin')
@section('titulo', 'Lista de Equipos')


@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h1>Registrar Regreso del Equipo</h1>

        <form action="{{ route('salidas.update', $salida->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="fecha_regreso">Fecha de Regreso</label>
                <input type="date" name="fecha_regreso" id="fecha_regreso" class="form-control"
                    value="{{ old('fecha_regreso') }}">
            </div>

            <div class="form-group">
                <label for="nota_regreso">Nota de Regreso</label>
                <textarea name="nota_regreso" id="nota_regreso" class="form-control">{{ old('nota_regreso') }}</textarea>
            </div>

            <div class="form-group">
                <label for="imagen_regreso">Actualizar Imagen de Regreso</label>
                <input type="file" name="imagen_regreso" id="imagen_regreso" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Registrar Regreso</button>
        </form>
    </div>
@endsection
