@extends('layouts.admin')

@section('titulo', 'Lista de Empresas')

@section('contenido')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <!-- Botón para abrir el modal de creación -->

    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createEmpresaModal">
        Crear Nueva Empresa
    </button>
    <div class="col-12 mt-4">

        <!-- Modal de creación -->
        <div class="modal fade" id="createEmpresaModal" tabindex="-1" aria-labelledby="createEmpresaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEmpresaModalLabel">Crear Nueva Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('empresas.store') }}" method="POST">
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
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td>{{ $empresa->nombre }}</td>
                            <td>
                                <!-- Botón para abrir el modal de detalles -->
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#showEmpresaModal-{{ $empresa->id }}">
                                    Ver
                                </button>

                                <!-- Modal de detalles -->
                                <div class="modal fade" id="showEmpresaModal-{{ $empresa->id }}" tabindex="-1"
                                    aria-labelledby="showEmpresaModalLabel-{{ $empresa->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showEmpresaModalLabel-{{ $empresa->id }}">
                                                    Detalles de la Empresa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{ $empresa->id }}</p>
                                                <p>Nombre: {{ $empresa->nombre }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Botón para abrir el modal de edición -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editEmpresaModal-{{ $empresa->id }}">
                                    Editar
                                </button>

                                <!-- Modal de edición -->
                                <div class="modal fade" id="editEmpresaModal-{{ $empresa->id }}" tabindex="-1"
                                    aria-labelledby="editEmpresaModalLabel-{{ $empresa->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editEmpresaModalLabel-{{ $empresa->id }}">
                                                    Editar Empresa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="nombre" class="form-label">Nombre:</label>
                                                        <input type="text" id="nombre" name="nombre"
                                                            class="form-control" value="{{ $empresa->nombre }}" required>
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
        {{ $empresas->links() }}
    </div>

@endsection
