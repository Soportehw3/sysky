@extends('layouts.admin')

@section('titulo', 'Editar Equipo')

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
            <form class="row g-3 needs-validation" novalidate action="{{ route('equipos.update', $equipo->id) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="col-md-3">
                    <label for="numero_serie" class="form-label">Número de Serie:</label>
                    <input type="text" class="form-control" id="numero_serie" name="numero_serie"
                        value="{{ $equipo->numero_serie }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="marca_id" class="form-label">Marca:</label>
                    <select id="marca_id" name="marca_id" class="form-control" required>
                        <option value="">Seleccione una Marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ $marca->id == $equipo->marca_id ? 'selected' : '' }}>
                                {{ $marca->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $equipo->modelo }}"
                        required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="etiqueta_skytex" class="form-label">Etiqueta Skytex:</label>
                    <input type="text" class="form-control" id="etiqueta_skytex" name="etiqueta_skytex"
                        value="{{ $equipo->etiqueta_skytex }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="tipo_equipo_id" class="form-label">Tipo:</label>
                    <select id="tipo_equipo_id" name="tipo_equipo_id" class="form-control" required>
                        <option value="">Seleccione un Tipo de Equipo</option>
                        @foreach ($tipoequipos as $tipoequipo)
                            <option value="{{ $tipoequipo->id }}" 
                                    @if(old('tipo_equipo_id', $equipo->tipo_equipo_id) == $tipoequipo->id) selected @endif>
                                {{ $tipoequipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="orden_compra" class="form-label">Orden De Compra:</label>
                    <input type="text" class="form-control" id="orden_compra" name="orden_compra"
                        value="{{ $equipo->orden_compra }}">
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="requisicion" class="form-label">Requisicion:</label>
                    <input type="text" class="form-control" id="requisicion" name="requisicion"
                        value="{{ $equipo->requisicion }}">
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" class="form-control" required>
                        <option value="Asignado" {{ $equipo->estado == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                        <option value="No asignado" {{ $equipo->estado == 'No asignado' ? 'selected' : '' }}>No asignado
                        </option>
                        <option value="Baja" {{ $equipo->estado == 'Baja' ? 'selected' : '' }}>Baja</option>
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">


                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div>
    </div>

@endsection
