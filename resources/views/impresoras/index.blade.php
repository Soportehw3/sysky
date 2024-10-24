@extends('layouts.admin')

@section('titulo', 'Listado de Impresoras')

@section('contenido')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Botón para agregar nueva impresora -->
            <a href="{{ route('impresoras.create') }}" class="btn btn-success">Agregar Nueva Impresora</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>IP</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Área</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($impresoras as $impresora)
                    <tr>
                        <td>{{ $impresora->nombre }}</td>
                        <td>{{ $impresora->ip }}</td>
                        <td>{{ $impresora->marca }}</td>
                        <td>{{ $impresora->modelo }}</td>
                        <td>{{ $impresora->area }}</td>
                        <td>
                            <!-- Estado con color dinámico -->
                            <span class="badge {{ $impresora->estado == 'En línea' ? 'bg-success' : 'bg-danger' }}">
                                {{ $impresora->estado }}
                            </span>
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('impresoras.show', $impresora->id) }}"
                                class="btn btn-info btn-sm me-2">Ver</a>
                            <a href="{{ route('impresoras.edit', $impresora->id) }}"
                                class="btn btn-warning btn-sm me-2">Editar</a>
                            <form action="{{ route('impresoras.destroy', $impresora->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta impresora?');">
                                @csrf
                                @method('DELETE')
                                <button hidden type="submit" class="btn btn-danger btn-sm me-2">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay impresoras registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection


@section('scripts')
    <script>
        function actualizarEstados() {
            fetch('{{ route('impresoras.estados') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    data.forEach(impresora => {
                        const estadoCelda = document.getElementById(`estado-${impresora.id}`);
                        if (estadoCelda) {
                            const badge = estadoCelda.querySelector('span');
                            badge.textContent = impresora.estado;
                            badge.className = 'badge'; // Reset class

                            // Cambiar color según estado
                            switch (impresora.estado.toLowerCase()) {
                                case 'en linea':
                                    badge.classList.add('bg-success');
                                    break;
                                case 'fuera de linea':
                                    badge.classList.add('bg-danger');
                                    break;
                                default:
                                    badge.classList.add('bg-warning');
                            }

                            // Actualizar atributos de accesibilidad
                            badge.setAttribute('aria-label', `Estado de la impresora: ${impresora.estado}`);
                        }
                    });
                })
                .catch(error => {
                    console.error('Error al obtener estados:', error);
                    mostrarMensajeError('Hubo un problema al actualizar los estados de las impresoras');
                });
        }

        function mostrarMensajeError(mensaje) {
            // Implementa esta función para mostrar un mensaje de error al usuario
            // Por ejemplo, podrías usar un elemento toast o un alert
            alert(mensaje);
        }

        // Actualiza los estados cada 30 segundos (ajustable según necesidades)
        const intervaloActualizacion = 0000;
        const intervalId = setInterval(actualizarEstados, intervaloActualizacion);

        // Llamada inicial para mostrar los estados al cargar la página
        actualizarEstados();

        // Opcionalmente, detener las actualizaciones si la página se oculta
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                clearInterval(intervalId);
            } else {
                setInterval(actualizarEstados, intervaloActualizacion);
            }
        });
    </script>
@endsection
