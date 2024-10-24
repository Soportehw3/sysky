@extends('layouts.admin')

@section('titulo', 'Editar Licencia')

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
            <form class="row g-3 needs-validation" novalidate action="{{ route('licencias.update', $licencia->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="col-md-4">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control"
                        value="{{ old('nombre', $licencia->nombre) }}" required>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="tipo_licencia_id">Tipo de Licencia:</label>
                    <select id="tipo_licencia_id" name="tipo_licencia_id" class="form-control select2" required>
                        <option value="">Seleccione un Tipo</option>
                        @foreach ($tiposLicencias as $tipoLicencia)
                            <option value="{{ $tipoLicencia->id }}"
                                {{ old('tipo_licencia_id', $licencia->tipo_licencia_id) == $tipoLicencia->id ? 'selected' : '' }}>
                                {{ $tipoLicencia->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="fecha_adquisicion">Fecha de Adquisición:</label>
                    <input type="date" id="fecha_adquisicion" name="fecha_adquisicion" class="form-control"
                        value="{{ old('fecha_adquisicion', $licencia->fecha_adquisicion) }}" required>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="frecuencia_pago">Frecuencia de Pago:</label>
                    <select id="frecuencia_pago" name="frecuencia_pago" class="form-control" required>
                        <option value="mensual" {{ old('frecuencia_pago', $licencia->frecuencia_pago) == 'mensual' ? 'selected' : '' }}>Mensual</option>
                        <option value="anual" {{ old('frecuencia_pago', $licencia->frecuencia_pago) == 'anual' ? 'selected' : '' }}>Anual</option>
                    </select>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="fecha_siguiente_pago">Fecha del Siguiente Pago:</label>
                    <input type="date" id="fecha_siguiente_pago" name="fecha_siguiente_pago" class="form-control"
                        value="{{ old('fecha_siguiente_pago', $licencia->fecha_siguiente_pago) }}" required>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="fecha_recordatorio">Fecha de Recordatorio:</label>
                    <input type="date" id="fecha_recordatorio" name="fecha_recordatorio" class="form-control"
                        value="{{ old('fecha_recordatorio', $licencia->fecha_recordatorio) }}">
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" class="form-control" required>
                        <option value="activa" {{ old('estado', $licencia->estado) == 'activa' ? 'selected' : '' }}>Activa</option>
                        <option value="vencida" {{ old('estado', $licencia->estado) == 'vencida' ? 'selected' : '' }}>Vencida</option>
                        <option value="cancelada" {{ old('estado', $licencia->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="observaciones">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" class="form-control">{{ old('observaciones', $licencia->observaciones) }}</textarea>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
