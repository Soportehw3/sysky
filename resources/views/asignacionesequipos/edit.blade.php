@extends('layouts.admin')

@section('titulo', 'Editar Asignación de Equipo')

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
            <form class="row g-3 needs-validation" novalidate
                action="{{ route('asignacionesequipos.update', $asignacion->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="col-md-3">
                    <label for="empleado_id" class="form-label">Empleado:</label>
                    <select id="empleado_id" name="empleado_id" class="form-control" required>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}"
                                {{ $asignacion->empleado_id == $empleado->id ? 'selected' : '' }}>{{ $empleado->nombre }}
                                {{ $empleado->apellidoP }} {{ $empleado->apellidoM }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="equipo_id" class="form-label">Equipo:</label>
                    <select id="equipo_id" name="equipo_id" class="form-control" required>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}"
                                {{ $asignacion->equipo_id == $equipo->id ? 'selected' : '' }}>{{ $equipo->etiqueta_skytex }}
                                - {{ $equipo->tipoEquipo->nombre ?? 'Sin Tipo' }}
                            </option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="fecha_asignacion" class="form-label">Fecha de Asignación:</label>
                    <input type="date" id="fecha_asignacion" name="fecha_asignacion" class="form-control"
                        value="{{ $asignacion->fecha_asignacion }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="ticket" class="form-label">Ticket:</label>
                    <input type="number" id="ticket" name="ticket" class="form-control"
                        value="{{ $asignacion->ticket }}">
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="nota_descriptiva" class="form-label">Nota Descriptiva:</label>
                    <textarea name="nota_descriptiva" id="nota_descriptiva" class="form-control" rows="4">{{ old('nota_descriptiva') ?? $asignacion->nota_descriptiva }}</textarea>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="empresa_id" class="form-label">Empresa:</label>
                    <select id="empresa_id" name="empresa_id" class="form-control" required>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}"
                                {{ $asignacion->empresa_id == $empresa->id ? 'selected' : '' }}>{{ $empresa->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <input type="text" id="estado" class="form-control" value="Asignado" disabled>
                    <input type="hidden" name="estado" value="Asignado">
                </div>

                <!--<div class="col-md-3">
                                <label for="estado" class="form-label">Estado:</label>
                                <select id="estado" name="estado" class="form-control" required>
                                    <option value="asignado" {{ $asignacion->estado == 'asignado' ? 'selected' : '' }}>Asignado
                                    </option>
                                    <option value="no asignado" {{ $asignacion->estado == 'no asignado' ? 'selected' : '' }}>No
                                        Asignado</option>
                                    <option value="prestamo" {{ $asignacion->estado == 'prestamo' ? 'selected' : '' }}>Préstamo
                                    </option>
                                    <option value="baja" {{ $asignacion->estado == 'baja' ? 'selected' : '' }}>Baja</option>
                                </select>
                                <div class="valid-feedback">
                                    Good!
                                </div>
                            </div>

                             imput para que aparesca si selecciona prestamo

                            <div class="col-md-3" id="fecha_regreso_container" style="display:none;">
                                <label for="fecha_regreso" class="form-label">Fecha de Regreso:</label>
                                <input type="date" id="fecha_regreso" name="fecha_regreso" class="form-control">
                            </div>-->

                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
    <!--Este escrip funciona para muestre el imput de Fecha de regreso si selecciona el estado de prestamo
                    <script>
                        document.getElementById('estado').addEventListener('change', function() {
                            var estado = this.value;
                            var fechaRegresoContainer = document.getElementById('fecha_regreso_container');

                            if (estado === 'prestamo') {
                                fechaRegresoContainer.style.display = 'block'; // Muestra el campo de fecha
                                document.getElementById('fecha_regreso').required =
                                    true; // Hace que el campo de fecha sea obligatorio
                            } else {
                                fechaRegresoContainer.style.display = 'none'; // Oculta el campo de fecha
                                document.getElementById('fecha_regreso').required = false; // No hace obligatorio el campo de fecha
                            }
                        });
                    </script>-->

@endsection
