@extends('layouts.admin')

@section('titulo', 'Crear Nueva Asignación de Accesorio')

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
            <form action="{{ route('asignacionaccesorios.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <label for="empleado_id" class="form-label">Empleado:</label>
                        <select id="empleado_id" name="empleado_id" class="form-control" required>
                            <option value="">Seleccione un empleado</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->nombre }} {{ $empleado->apellidoP }} {{ $empleado->apellidoM }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="accesorio_id" class="form-label">Accesorio:</label>
                        <select name="accesorio_id" id="accesorio_id" class="form-control" required>
                            <option value="">Seleccione un Accesorio</option>
                            @foreach ($accesorios as $accesorio)
                                <option value="{{ $accesorio->id }}">{{ $accesorio->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="cantidad_asignada" class="form-label">Cantidad Asignada:</label>
                        <input type="number" name="cantidad_asignada" id="cantidad_asignada" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-3">
                        <label for="fecha_asignacion" class="form-label">Fecha de Asignación:</label>
                        <input type="date" class="form-control" id="datepicker" name="fecha_asignacion" required>
                    </div>

                    <div class="col-md-3">
                        <label for="ticket" class="form-label">Ticket:</label>
                        <input type="number" class="form-control" id="ticket" name="ticket" required>
                    </div>

                    <div class="col-md-3">
                        <label for="nota_descriptiva" class="form-label">Nota Descriptiva:</label>
                        <input type="text" class="form-control" id="nota_descriptiva" name="nota_descriptiva" required>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection
