@extends('layouts.admin')

@section('titulo', 'Editar Accesorio')

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
            <form class="row g-3 needs-validation" novalidate action="{{ route('accesorios.update', $accesorio->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="col-md-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $accesorio->descripcion }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" value="{{ $accesorio->marca }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $accesorio->modelo }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="text" class="form-control" id="cantidad" name="cantidad" value="{{ $accesorio->cantidad }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="orden_compra_acc" class="form-label">Orden de Compra:</label>
                    <input type="text" class="form-control" id="orden_compra_acc" name="orden_compra_acc" value="{{ $accesorio->orden_compra_acc }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="requisicion" class="form-label">Requisición:</label>
                    <input type="text" class="form-control" id="requisicion" name="requisicion" value="{{ $accesorio->requisicion }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="cantidad_minima" class="form-label">Cantidad Mínima:</label>
                    <input type="text" class="form-control" id="cantidad_minima" name="cantidad_minima" value="{{ $accesorio->cantidad_minima }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
