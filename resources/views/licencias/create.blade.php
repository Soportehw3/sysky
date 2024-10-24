@extends('layouts.admin')

@section('titulo', 'Crear Nueva Licencia')

@section('contenido')

    <!-- Mostrar errores de validación -->
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
            <form class="row g-3 needs-validation" novalidate action="{{ route('licencias.store') }}" method="POST">
                @csrf
                
                <!-- Tipo de Licencia -->
                <div class="col-md-4">
                    <label for="tipo_licencia_id" class="form-label">Tipo de Licencia</label>
                    <select name="tipo_licencia_id" id="tipo_licencia_id" class="form-control select2" required>
                        <option value="">Selecciona un tipo de licencia</option>
                        @foreach ($tiposLicencias as $tipoLicencia)
                            <option value="{{ $tipoLicencia->id }}">{{ $tipoLicencia->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Nombre -->
                <div class="col-md-4">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Fecha de Adquisición -->
                <div class="col-md-4">
                    <label for="fecha_adquisicion" class="form-label">Fecha de Adquisición</label>
                    <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Frecuencia de Pago -->
                <div class="col-md-4">
                    <label for="frecuencia_pago" class="form-label">Frecuencia de Pago</label>
                    <select name="frecuencia_pago" id="frecuencia_pago" class="form-control select2" required>
                        <option value="mensual">Mensual</option>
                        <option value="semestral">Semestral</option>
                        <option value="anual">Anual</option>
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Fecha del Siguiente Pago -->
                <div class="col-md-4">
                    <label for="fecha_siguiente_pago" class="form-label">Fecha del Siguiente Pago</label>
                    <input type="date" class="form-control" id="fecha_siguiente_pago" name="fecha_siguiente_pago" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Fecha de Recordatorio -->
                <div class="col-md-4">
                    <label for="fecha_recordatorio" class="form-label">Fecha de Recordatorio</label>
                    <input type="date" class="form-control" id="fecha_recordatorio" name="fecha_recordatorio" 
                        value="{{ old('fecha_recordatorio', $licencia->fecha_recordatorio ?? '') }}">
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Estado -->
                <div class="col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-control select2" required>
                        <option value="activa">Activa</option>
                        <option value="vencida">Vencida</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="col-md-12">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Botón de Enviar -->
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Incluye Select2 CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Inicializar Select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Selecciona una opción",
                allowClear: true
            });
        });
    </script>
@endsection
