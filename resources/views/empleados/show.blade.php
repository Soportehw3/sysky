@extends('layouts.admin')

@section('titulo', 'Detalles del Empleado')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <td>{{ $empleado->id }}</td>
                    </tr>
                    <tr>
                        <th>Número de Nómina</th>
                        <td>{{ $empleado->numero_nomina }}</td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td>{{ $empleado->nombre }}</td>
                    </tr>
                    <tr>
                        <th>Apellido Paterno</th>
                        <td>{{ $empleado->apellidoP }}</td>
                    </tr>
                    <tr>
                        <th>Apellido Materno</th>
                        <td>{{ $empleado->apellidoM }}</td>
                    </tr>
                    <tr>
                        <th>Puesto</th>
                        <td>{{ $empleado->puesto }}</td>
                    </tr>
                    <tr>
                        <th>Área</th>
                        <td>{{ $empleado->area }}</td>
                    </tr>
                </table>
            </div>


            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary">Editar</a>

            <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('¿Está seguro de que desea eliminar este empleado?')">Eliminar</button>
            </form>
        </div>
    </div>

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <h3>Equipos Asignados</h3>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número de Serie</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleado->asignacionesequipos as $asignacion)
                            <tr>
                                <td>{{ $asignacion->equipo->id }}</td>
                                <td>{{ $asignacion->equipo->numero_serie }}</td>
                                <td>{{ $asignacion->equipo->marca }}</td>
                                <td>{{ $asignacion->equipo->modelo }}</td>
                                <td>{{ $asignacion->equipo->tipo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <h3>Accesorios Asignados</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleado->asignacionesaccesorios as $asignacion)
                            <tr>
                                <td>{{ $asignacion->accesorio->id }}</td>
                                <td>{{ $asignacion->accesorio->descripcion }}</td>
                                <td>{{ $asignacion->accesorio->marca }}</td>
                                <td>{{ $asignacion->accesorio->modelo }}</td>
                                <td>{{ $asignacion->cantidad_asignada }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <h3>Préstamos Realizados</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Equipo</th>
                            <th>Fecha de Préstamo</th>
                            <th>Fecha de Regreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleado->prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->id }}</td>
                                <td>{{ $prestamo->equipo->modelo }}</td>
                                <td>{{ $prestamo->fecha_prestamo }}</td>
                                <td>{{ $prestamo->fecha_regreso }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
