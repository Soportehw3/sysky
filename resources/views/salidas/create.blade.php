@extends('layouts.admin')

@section('titulo', 'Registrar Nueva Salida')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <form action="{{ route('salidas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="equipo_id">Equipo</label>
                    <select name="equipo_id" id="equipo_id" class="form-control @error('equipo_id') is-invalid @enderror"
                        required>
                        <option value="">Seleccione un equipo</option>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->etiqueta_skytex }} -  {{ $equipo->tipoEquipo->nombre ?? 'Sin Tipo' }}
                            </option>
                        @endforeach
                    </select>
                    @error('equipo_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="empleado_id">Empleado</label>
                    <select name="empleado_id" id="empleado_id"
                        class="form-control @error('empleado_id') is-invalid @enderror" required>
                        <option value="">Seleccione un empleado</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                {{ $empleado->nombre }} {{ $empleado->apellidoP }} {{ $empleado->apellidoM }}
                            </option>
                        @endforeach
                    </select>
                    @error('empleado_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fecha_salida">Fecha de Salida</label>
                    <input type="date" name="fecha_salida" id="fecha_salida"
                        class="form-control @error('fecha_salida') is-invalid @enderror" value="{{ old('fecha_salida') }}"
                        required>
                    @error('fecha_salida')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nota_salida">Nota de Salida</label>
                    <textarea name="nota_salida" id="nota_salida" class="form-control @error('nota_salida') is-invalid @enderror" required>{{ old('nota_salida') }}</textarea>
                    @error('nota_salida')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen de Salida</label>
                    <input type="file" name="imagen" id="imagen"
                        class="form-control-file @error('imagen') is-invalid @enderror">
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Registrar Salida</button>
            </form>
        </div>
    </div>
@endsection
<script>
    $(document).ready(function() {
        $('#equipo_id').select2({
            theme: "bootstrap-5",
            placeholder: 'Seleccione un equipo',
            width: 'resolve',
            allowClear: true
        }).on('select2:open', function() {
            setTimeout(function() {
                $('.select2-container--open .select2-search__field').focus();
            }, 0);
        });
    });
</script>
