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
                        <label for="empleado_id">Empleado:</label>
                        <select name="empleado_id" id="empleado_id" class="form-control">
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>



                    <div class="col-md-3">
                        <label for="accesorio_id" class="form-label">Accesorio:</label>
                        <select name="accesorio_id" id="accesorio_id" class="form-control" required>
                            @foreach ($accesorios as $accesorio)
                                <option value="{{ $accesorio->id }}">{{ $accesorio->descripcion }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>


                    <div class="col-md-3">
                        <label for="cantidad_asignada">Cantidad Asignada:</label>
                        <input type="number" name="cantidad_asignada" id="cantidad_asignada" class="form-control" min="1" required>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="fecha_asignacion" class="form-label">Fecha de Asignación:</label>
                        <input type="date" class="form-control" id="fecha_asignacion" name="fecha_asignacion" required>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="usuario_responsable" class="form-label">Usuario Responsable:</label>
                        <select id="usuario_responsable" name="usuario_responsable" class="form-control" required>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="col-md-3">
                        <label for="ticket" class="form-label">Ticket</label>
                        <input type="number" class="form-control" id="ticket" name="ticket" required>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>


                    <div class="col-md-3">
                        <label for="nota_descriptiva" class="form-label">Nota Descriptiva:</label>
                        <input type="text" class="form-control" id="nota_descriptiva" name="nota_descriptiva" required>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection
