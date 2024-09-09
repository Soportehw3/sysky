@extends('layouts.admin')

@section('titulo', 'Lista de Marcas de Equipo')

@section('contenido')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botón para abrir el modal de creación -->
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createMarcaModal">
        Crear Nueva Marca de Equipo
    </button>

    <div class="col-12 mt-4">
        <!-- Modal de creación -->
        <div class="modal fade" id="createMarcaModal" tabindex="-1" aria-labelledby="createMarcaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createMarcaModalLabel">Crear Nueva Marca de Equipo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('marcas.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <td>{{ $marca->nombre }}</td>
                            <td>
                                <!-- Botón para abrir el modal de edición -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editMarcaModal-{{ $marca->id }}">
                                    Editar
                                </button>

                                <!-- Modal de edición -->
                                <div class="modal fade" id="editMarcaModal-{{ $marca->id }}" tabindex="-1"
                                    aria-labelledby="editMarcaModalLabel-{{ $marca->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editMarcaModalLabel-{{ $marca->id }}">Editar
                                                    Marca de Equipo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('marcas.update', $marca->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="nombre" class="form-label">Nombre:</label>
                                                        <input type="text" id="nombre" name="nombre"
                                                            class="form-control" value="{{ $marca->nombre }}" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $marcas->links() }}
@endsection
