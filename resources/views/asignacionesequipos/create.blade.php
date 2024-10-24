@extends('layouts.admin')

@section('titulo', 'Crear Nueva Asignación de Equipo')

@section('contenido')

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="asignaciones-form" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <label for="empleado_id" class="form-label">Empleado:</label>
                                <select id="empleado_id" class="form-control" required>
                                    <option value="">Seleccione un empleado</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }}
                                            {{ $empleado->apellidoP }} {{ $empleado->apellidoM }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="equipo_id" class="form-label">Equipo:</label>
                                <select id="equipo_id" class="form-control" required>
                                    <option value="">Seleccione un equipo</option>
                                    @foreach ($equipos as $equipo)
                                        <option value="{{ $equipo->id }}"> {{ $equipo->etiqueta_skytex }} -
                                            {{ $equipo->tipoEquipo->nombre ?? 'Sin Tipo' }} - {{ $equipo->numero_serie }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-3">
                                <label for="fecha_asignacion" class="form-label">Fecha de Asignación:</label>
                                <input type="date" id="fecha_asignacion" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label for="ticket" class="form-label">Ticket:</label>
                                <input type="number" id="ticket" class="form-control" min="1" pattern="^[0-9]+-"
                                    autocomplete="off">
                            </div>


                            <div class="col-md-6">
                                <label for="nota_descriptiva" class="form-label">Nota Descriptiva:</label>
                                <textarea name="nota_descriptiva" type="text" id="nota_descriptiva" class="form-control" cols="30"
                                    rows="3"></textarea>
                            </div>

                            <div class="col-md-3">
                                <label for="empresa_id" class="form-label">Empresa:</label>
                                <select id="empresa_id" class="form-control" required>
                                    <option value="">Seleccione una empresa</option>
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="estado" class="form-label">Estado:</label>
                                <input type="text" id="estado" class="form-control" value="Asignado" disabled>
                                <input type="hidden" name="estado" value="Asignado">
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="button" class="btn btn-secondary" onclick="addAsignacion()">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-bordered" id="asignaciones-table">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Equipo</th>
                                <th>Fecha de Asignación</th>
                                <th>Ticket</th>
                                <th>Nota Descriptiva</th>
                                <th>Empresa</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Las asignaciones se agregarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 mt-3">
                <form action="{{ route('asignacionesequipos.store') }}" method="POST" id="final-asignaciones-form">
                    @csrf
                    <input type="hidden" name="asignaciones" id="asignaciones-input">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let asignaciones = [];

        function validateForm() {
            const empleadoId = document.getElementById('empleado_id').value;
            const equipoId = document.getElementById('equipo_id').value;
            const fechaAsignacion = document.getElementById('fecha_asignacion').value;
            const ticket = document.getElementById('ticket').value;
            const empresaId = document.getElementById('empresa_id').value;
            const estado = document.getElementById('estado').value;

            if (!empleadoId || !equipoId || !fechaAsignacion || !ticket || !empresaId || !estado) {
                alert('Por favor complete todos los campos requeridos.');
                return false;
            }

            return true;
        }

        function addAsignacion() {
            if (!validateForm()) {
                return;
            }

            const equipoId = document.getElementById('equipo_id').value;

            // Verificar si el equipo ya está en la tabla temporal
            const equipoYaAsignado = asignaciones.some(asignacion => asignacion.equipo_id === equipoId);

            if (equipoYaAsignado) {
                alert('El equipo ya ha sido asignado.');
                return; // No continuar si el equipo ya está asignado
            }

            const empleadoId = document.getElementById('empleado_id').value;
            const empleadoText = document.getElementById('empleado_id').options[document.getElementById('empleado_id')
                .selectedIndex].text;
            const equipoText = document.getElementById('equipo_id').options[document.getElementById('equipo_id')
                .selectedIndex].text;
            const fechaAsignacion = document.getElementById('fecha_asignacion').value;
            const ticket = document.getElementById('ticket').value;
            const notaDescriptiva = document.getElementById('nota_descriptiva').value;
            const empresaId = document.getElementById('empresa_id').value;
            const empresaText = document.getElementById('empresa_id').options[document.getElementById('empresa_id')
                .selectedIndex].text;
            const estado = document.getElementById('estado').value;

            const asignacion = {
                empleado_id: empleadoId,
                equipo_id: equipoId,
                fecha_asignacion: fechaAsignacion,
                ticket: ticket,
                nota_descriptiva: notaDescriptiva,
                empresa_id: empresaId,
                estado: estado
            };

            asignaciones.push(asignacion);

            const tableBody = document.getElementById('asignaciones-table').getElementsByTagName('tbody')[0];
            const newRow = tableBody.insertRow();

            newRow.innerHTML = `
            <td>${empleadoText}</td>
            <td>${equipoText}</td>
            <td>${fechaAsignacion}</td>
            <td>${ticket}</td>
            <td>${notaDescriptiva}</td>
            <td>${empresaText}</td>
            <td>${estado}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeAsignacion(${asignaciones.length - 1})">Eliminar</button></td>
        `;

            // Limpiar el campo del equipo (Select2)
            $('#equipo_id').val(null).trigger('change');
        }



        function removeAsignacion(index) {
            asignaciones.splice(index, 1);
            const tableBody = document.getElementById('asignaciones-table').getElementsByTagName('tbody')[0];
            tableBody.deleteRow(index);

            // Actualizar los índices de los botones de eliminar
            for (let i = 0; i < tableBody.rows.length; i++) {
                tableBody.rows[i].getElementsByTagName('button')[0].setAttribute('onclick', `removeAsignacion(${i})`);
            }
        }

        document.getElementById('final-asignaciones-form').addEventListener('submit', function(event) {
            if (asignaciones.length === 0) {
                event.preventDefault();
                alert('Debe agregar al menos una asignación antes de crear.');
                return;
            }
            document.getElementById('asignaciones-input').value = JSON.stringify(asignaciones);
        });
    </script>
@endsection
