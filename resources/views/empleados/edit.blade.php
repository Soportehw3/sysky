@extends('layouts.admin')

@section('titulo', 'Editar Empleado')

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
            <form class="row g-3 needs-validation" novalidate action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="col-md-3">
                    <label for="numero_nomina" class="form-label">Número de Nómina:</label>
                    <input type="text" class="form-control" id="numero_nomina" name="numero_nomina" value="{{ $empleado->numero_nomina }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empleado->nombre }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="apellidoP" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellidoP" name="apellidoP" value="{{ $empleado->apellidoP }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md3">
                    <label for="apellidoM" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellidoM" name="apellidoM" value="{{ $empleado->apellidoM }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="puesto" class="form-label">Puesto</label>
                    <input type="text" class="form-control" id="puesto" name="puesto" value="{{ $empleado->puesto }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="area" class="form-label">Área</label>
                    <input type="text" class="form-control" id="area" name="area" value="{{ $empleado->area }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label">Estatus</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ $empleado->status }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

@endsection
