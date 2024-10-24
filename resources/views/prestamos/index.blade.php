@extends('layouts.admin')

@section('titulo', 'Lista de Préstamos')

@section('contenido')

    <div>
        <a href="{{ route('prestamos.create') }}" class="btn btn-secondary mb-3">Registrar Nuevo Préstamo +</a>
    </div>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('prestamos.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por empleado, equipo o responsable"
                value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Formulario para generar PDF -->
    <form id="pdf-form" action="{{ route('prestamos.pdfMultiple') }}" method="POST" target="_blank">
        @csrf
        <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
            <div class="card-body">

                <!-- Botón Generar PDF -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Generar PDF seleccionados.</button>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Empleado</th>
                            <th>Equipo</th>
                            <th>Fecha de Préstamo</th>
                            <th>Fecha de Regreso</th>
                            <th>Responsable</th>
                            <th>Devuelto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestamos as $prestamo)
                            <tr>
                                <td><input type="checkbox" name="prestamos[]" value="{{ $prestamo->id }}"></td>
                                <td>{{ $prestamo->empleado->nombre ?? 'N/A' }} {{ $prestamo->empleado->apellidoP ?? 'N/A' }}
                                    {{ $prestamo->empleado->apellidoM ?? 'N/A' }}</td>
                                <td>{{ $prestamo->equipo->etiqueta_skytex }}</td>
                                <td>{{ $prestamo->fecha_prestamo }}</td>
                                <td>{{ $prestamo->fecha_regreso }}</td>
                                <td>{{ $prestamo->usuario->name }}</td>
                                <td>{{ $prestamo->devuelto ? 'Sí' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('prestamos.show', $prestamo->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('prestamos.edit', $prestamo->id) }}?page={{ $prestamos->currentPage() }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    <a href="{{ route('prestamos.pdf', $prestamo->id) }}" class="btn btn-primary btn-sm"
                                        target="_blank">Ver PDF</a>
                                    <!--<form hidden action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Está seguro de que desea eliminar este préstamo?')">Eliminar</button>
                                    </form>-->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                {{ $prestamos->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </form>

    <script>
        // Seleccionar/Deseleccionar todos los checkboxes
        document.getElementById('select-all').addEventListener('click', function (event) {
            const checkboxes = document.querySelectorAll('input[name="prestamos[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
        });
    </script>
    <script>
        // Seleccionar/Deseleccionar todos los checkboxes
        document.getElementById('select-all').addEventListener('click', function (event) {
            const checkboxes = document.querySelectorAll('input[name="prestamos[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
        });
    
        // Validar si hay algún checkbox seleccionado antes de enviar el formulario
        document.getElementById('pdf-form').addEventListener('submit', function (event) {
            const checkboxes = document.querySelectorAll('input[name="prestamos[]"]:checked');
            
            if (checkboxes.length === 0) {
                event.preventDefault(); // Evitar que el formulario se envíe
                alert('Por favor, selecciona al menos un préstamo para generar el PDF.');
            }
        });
    </script>
@endsection
