@extends('layouts.admin')

@section('titulo', 'Editar Préstamo')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('prestamos.update', $prestamo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="empleado_id">Empleado:</label>
                    <select id="empleado_id" name="empleado_id" class="form-control" required>
                        <option value="">Seleccione un empleado</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}"
                                {{ $prestamo->empleado_id == $empleado->id ? 'selected' : '' }}>
                                {{ $empleado->nombre }} {{ $empleado->apellidoP }} {{ $empleado->apellidoM }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="equipo_id">Equipo:</label>
                    <select id="equipo_id" name="equipo_id" class="form-control" required>
                        <option value="">Seleccione un equipo</option>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ $prestamo->equipo_id == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->etiqueta_skytex }} - {{ $equipo->tipoEquipo->nombre ?? 'Sin Tipo' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_prestamo">Fecha de Préstamo:</label>
                    <input type="date" id="fecha_prestamo" name="fecha_prestamo" class="form-control"
                        value="{{ $prestamo->fecha_prestamo }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_regreso">Fecha de Regreso:</label>
                    <input type="date" id="fecha_regreso" name="fecha_regreso" class="form-control"
                        value="{{ $prestamo->fecha_regreso }}" required>
                </div>

                <!-- Nuevo campo para la nota de préstamo -->
                <div class="form-group">
                    <label for="nota_prestamo">Observaciones:</label>
                    <textarea id="nota_prestamo" name="nota_prestamo" class="form-control" required>{{ old('nota_prestamo', $prestamo->nota_prestamo) }}</textarea>
                </div>


                <input type="hidden" name="devuelto" value="0">
                <div class="form-group">
                    <label for="devuelto">¿Devuelto?</label>
                    <input type="checkbox" id="devuelto" name="devuelto" value="1"
                        {{ $prestamo->devuelto ? 'checked' : '' }}>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@endsection
