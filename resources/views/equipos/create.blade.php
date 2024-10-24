@extends('layouts.admin')

@section('titulo', 'Crear Nuevo Equipo')

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

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <form class="row g-3 needs-validation" novalidate action="{{ route('equipos.store') }}" method="POST">
                @csrf

                <div class="col-md-3">
                    <label for="numero_serie" class="form-label">Número de Serie:</label>
                    <input type="text" class="form-control" id="numero_serie" name="numero_serie" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="marca_id" class="form-label">Marca:</label>
                    <select id="marca_id" name="marca_id" class="form-control" required>
                        <option value="">Seleccione una Marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>



                <div class="col-md-3">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="etiqueta_skytex" class="form-label">Etiqueta Skytex:</label>
                    <input type="text" class="form-control" id="etiqueta_skytex" name="etiqueta_skytex" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="tipo_equipo_id" class="form-label">Tipo:</label>
                    <select id="tipo_equipo_id" name="tipo_equipo_id" class="form-control" required>
                        <option value="">Seleccione un Tipo de Equipo</option>
                        @foreach ($tipoequipos as $tipoequipo)
                            <option value="{{ $tipoequipo->id }}"> {{ $tipoequipo->nombre }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="orden_compra" class="form-label">Orden De Compra:</label>
                    <input type="text" class="form-control" id="orden_compra" name="orden_compra" >
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="requisicion" class="form-label">Requisición:</label>
                    <input type="text" class="form-control" id="requisicion" name="requisicion" >
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Campo oculto para el estado por defecto -->
                <input type="hidden" name="estado" value="No asignado">

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>

            </form>
        </div>
    </div>

@endsection
