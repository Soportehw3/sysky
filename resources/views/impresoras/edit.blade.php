@extends('layouts.admin')

@section('titulo', 'Lista de Equipos')

@section('contenido')
    <div class="container">
        <h1>Editar Impresora</h1>

        <form action="{{ route('impresoras.update', $impresora->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $impresora->nombre }}" required>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" class="form-control" value="{{ $impresora->modelo }}" required>
            </div>

            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" name="marca" class="form-control" value="{{ $impresora->marca }}" required>
            </div>

            <div class="form-group">
                <label for="area">Área</label>
                <input type="text" name="area" class="form-control" value="{{ $impresora->area }}" required>
            </div>

            <div class="form-group">
                <label for="ip">Dirección IP</label>
                <input type="text" name="ip" class="form-control" value="{{ $impresora->ip }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
            <a href="{{ route('impresoras.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
@endsection
