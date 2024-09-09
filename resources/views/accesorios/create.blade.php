@extends('layouts.admin')

@section('titulo', 'Crear Nuevo Accesorio')

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
            <form class="row g-3 needs-validation" novalidate action="{{ route('accesorios.store') }}" method="POST">
                @csrf

                <div class="col-md-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="marca_id" class="form-label">Marca:</label>
                    <select id="marca_id" name="marca_id" class="form-control" required>
                        <option value="">Seleccione una Marca</option>
                        @foreach ($marcasAccesorios as $marcaAccesorio)
                            <option value="{{ $marcaAccesorio->id }}">{{ $marcaAccesorio->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>
                
                
                <div class="col-md-3">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="number" min="1" pattern="^[0-9]+" class="form-control" id="cantidad" name="cantidad" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="orden_compra_acc" class="form-label">Orden De Compra:</label>
                    <input type="number" min="1" pattern="^[0-9]+" class="form-control" id="orden_compra_acc" name="orden_compra_acc">
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="requisicion" class="form-label">Requisición:</label>
                    <input type="number" min="1" pattern="^[0-9]+" class="form-control" id="requisicion" name="requisicion">
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="cantidad_minima" class="form-label">Cantidad Mínima:</label>
                    <input type="number" min="1" pattern="^[0-9]+" class="form-control" id="cantidad_minima" name="cantidad_minima" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>


                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>

            </form>
        </div>
    </div>
@endsection
