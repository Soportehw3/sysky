@extends('layouts.admin')

@section('titulo', 'Editar Equipo')

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
            <form class="row g-3 needs-validation" novalidate action="{{ route('equipos.update', $equipo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="col-md-3">
                    <label for="numero_serie" class="form-label">Número de Serie:</label>
                    <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="{{ $equipo->numero_serie }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="marca" class="form-label">Marca:</label>
                    <select id="marca" name="marca" class="form-control" required>
                        <option value="">Seleccione una marca</option>
                        <option value="ACER" {{ $equipo->marca == 'ACER' ? 'selected' : '' }}>ACER</option>
                        <option value="ADC" {{ $equipo->marca == 'ADC' ? 'selected' : '' }}>ADC</option>
                        <option value="AOC" {{ $equipo->marca == 'AOC' ? 'selected' : '' }}>AOC</option>
                        <option value="APPLE" {{ $equipo->marca == 'APPLE' ? 'selected' : '' }}>APPLE</option>
                        <option value="ASUS" {{ $equipo->marca == 'ASUS' ? 'selected' : '' }}>ASUS</option>
                        <option value="BAMBOO" {{ $equipo->marca == 'BAMBOO' ? 'selected' : '' }}>BAMBOO</option>
                        <option value="BENQ" {{ $equipo->marca == 'BENQ' ? 'selected' : '' }}>BENQ</option>
                        <option value="CANON" {{ $equipo->marca == 'CANON' ? 'selected' : '' }}>CANON</option>
                        <option value="CHINO" {{ $equipo->marca == 'CHINO' ? 'selected' : '' }}>CHINO</option>
                        <option value="DELL" {{ $equipo->marca == 'DELL' ? 'selected' : '' }}>DELL</option>
                        <option value="EMACHINES" {{ $equipo->marca == 'EMACHINES' ? 'selected' : '' }}>EMACHINES</option>
                        <option value="ENSAMBLE" {{ $equipo->marca == 'ENSAMBLE' ? 'selected' : '' }}>ENSAMBLE</option>
                        <option value="EPSON" {{ $equipo->marca == 'EPSON' ? 'selected' : '' }}>EPSON</option>
                        <option value="GODEX" {{ $equipo->marca == 'GODEX' ? 'selected' : '' }}>GODEX</option>
                        <option value="HISENSE" {{ $equipo->marca == 'HISENSE' ? 'selected' : '' }}>HISENSE</option>
                        <option value="HONEYWELL" {{ $equipo->marca == 'HONEYWELL' ? 'selected' : '' }}>HONEYWELL</option>
                        <option value="HP" {{ $equipo->marca == 'HP' ? 'selected' : '' }}>HP</option>
                        <option value="HUAWEI" {{ $equipo->marca == 'HUAWEI' ? 'selected' : '' }}>HUAWEI</option>
                        <option value="INTOUS" {{ $equipo->marca == 'INTOUS' ? 'selected' : '' }}>INTOUS</option>
                        <option value="KODAK" {{ $equipo->marca == 'KODAK' ? 'selected' : '' }}>KODAK</option>
                        <option value="KYOCERA" {{ $equipo->marca == 'KYOCERA' ? 'selected' : '' }}>KYOCERA</option>
                        <option value="LENOVO" {{ $equipo->marca == 'LENOVO' ? 'selected' : '' }}>LENOVO</option>
                        <option value="LG" {{ $equipo->marca == 'LG' ? 'selected' : '' }}>LG</option>
                        <option value="MITEL" {{ $equipo->marca == 'MITEL' ? 'selected' : '' }}>MITEL</option>
                        <option value="PANASONIC" {{ $equipo->marca == 'PANASONIC' ? 'selected' : '' }}>PANASONIC</option>
                        <option value="PIXEL" {{ $equipo->marca == 'PIXEL' ? 'selected' : '' }}>PIXEL</option>
                        <option value="RASPBERRY" {{ $equipo->marca == 'RASPBERRY' ? 'selected' : '' }}>RASPBERRY</option>
                        <option value="SAMSUNG" {{ $equipo->marca == 'SAMSUNG' ? 'selected' : '' }}>SAMSUNG</option>
                        <option value="SANSUI" {{ $equipo->marca == 'SANSUI' ? 'selected' : '' }}>SANSUI</option>
                        <option value="SATO" {{ $equipo->marca == 'SATO' ? 'selected' : '' }}>SATO</option>
                        <option value="SIN MARCA" {{ $equipo->marca == 'SIN MARCA' ? 'selected' : '' }}>SIN MARCA</option>
                        <option value="TAO" {{ $equipo->marca == 'TAO' ? 'selected' : '' }}>TAO</option>
                        <option value="TP-LINK" {{ $equipo->marca == 'TP-LINK' ? 'selected' : '' }}>TP-LINK</option>
                        <option value="TRIPPLITE" {{ $equipo->marca == 'TRIPPLITE' ? 'selected' : '' }}>TRIPPLITE</option>
                        <option value="TRUEMETER" {{ $equipo->marca == 'TRUEMETER' ? 'selected' : '' }}>TRUEMETER</option>
                        <option value="UNITECH" {{ $equipo->marca == 'UNITECH' ? 'selected' : '' }}>UNITECH</option>
                        <option value="VIEWSONIC" {{ $equipo->marca == 'VIEWSONIC' ? 'selected' : '' }}>VIEWSONIC</option>
                        <option value="VIISAN" {{ $equipo->marca == 'VIISAN' ? 'selected' : '' }}>VIISAN</option>
                        <option value="X-RITE" {{ $equipo->marca == 'X-RITE' ? 'selected' : '' }}>X-RITE</option>
                        <option value="ZEBRA" {{ $equipo->marca == 'ZEBRA' ? 'selected' : '' }}>ZEBRA</option>
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>
                

                <div class="col-md-3">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $equipo->modelo }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="etiqueta_skytex" class="form-label">Etiqueta Skytex:</label>
                    <input type="text" class="form-control" id="etiqueta_skytex" name="etiqueta_skytex" value="{{ $equipo->etiqueta_skytex }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <select id="tipo" name="tipo" class="form-control" required>
                        <option value="">Seleccione un tipo de equipo</option>
                        <option value="AIO-PCTOUCHPANEL" {{ $equipo->tipo == 'AIO-PCTOUCHPANEL' ? 'selected' : '' }}>AIO-PCTOUCHPANEL</option>
                        <option value="AP" {{ $equipo->tipo == 'AP' ? 'selected' : '' }}>AP</option>
                        <option value="COMPUTADORA" {{ $equipo->tipo == 'COMPUTADORA' ? 'selected' : '' }}>COMPUTADORA</option>
                        <option value="CTELEFONOPU" {{ $equipo->tipo == 'CTELEFONOPU' ? 'selected' : '' }}>TELEFONO</option>
                        <option value="CUENTAMETROS" {{ $equipo->tipo == 'CUENTAMETROS' ? 'selected' : '' }}>CUENTAMETROS</option>
                        <option value="ESCANER" {{ $equipo->tipo == 'ESCANER' ? 'selected' : '' }}>ESCANER</option>
                        <option value="ESPECTRO" {{ $equipo->tipo == 'ESPECTRO' ? 'selected' : '' }}>ESPECTRO</option>
                        <option value="iMAC" {{ $equipo->tipo == 'iMAC' ? 'selected' : '' }}>iMAC</option>
                        <option value="LAPTOP" {{ $equipo->tipo == 'LAPTOP' ? 'selected' : '' }}>LAPTOP</option>
                        <option value="LECTOR CB" {{ $equipo->tipo == 'LECTOR CB' ? 'selected' : '' }}>LECTOR CB</option>
                        <option value="LECTOR CD/DVD/BLUERAY" {{ $equipo->tipo == 'LECTOR CD/DVD/BLUERAY' ? 'selected' : '' }}>LECTOR CD/DVD/BLUERAY</option>
                        <option value="Macbook Air" {{ $equipo->tipo == 'Macbook Air' ? 'selected' : '' }}>Macbook Air</option>
                        <option value="MINIPC" {{ $equipo->tipo == 'MINIPC' ? 'selected' : '' }}>MINIPC</option>
                        <option value="MONITOR" {{ $equipo->tipo == 'MONITOR' ? 'selected' : '' }}>MONITOR</option>
                        <option value="MULTIFUN" {{ $equipo->tipo == 'MULTIFUN' ? 'selected' : '' }}>MULTIFUN</option>
                        <option value="PRENSA" {{ $equipo->tipo == 'PRENSA' ? 'selected' : '' }}>PRENSA</option>
                        <option value="PRINTER BN" {{ $equipo->tipo == 'PRINTER BN' ? 'selected' : '' }}>PRINTER BN</option>
                        <option value="PRINTER COLOR" {{ $equipo->tipo == 'PRINTER COLOR' ? 'selected' : '' }}>PRINTER COLOR</option>
                        <option value="PRINTER TERM" {{ $equipo->tipo == 'PRINTER TERM' ? 'selected' : '' }}>PRINTER TERM</option>
                        <option value="PROYECTOR" {{ $equipo->tipo == 'PROYECTOR' ? 'selected' : '' }}>PROYECTOR</option>
                        <option value="RASPBERRY" {{ $equipo->tipo == 'RASPBERRY' ? 'selected' : '' }}>RASPBERRY</option>
                        <option value="Speaker/Mic Google" {{ $equipo->tipo == 'Speaker/Mic Google' ? 'selected' : '' }}>Speaker/Mic Google</option>
                        <option value="SWITCH" {{ $equipo->tipo == 'SWITCH' ? 'selected' : '' }}>SWITCH</option>
                        <option value="TABLETA" {{ $equipo->tipo == 'TABLETA' ? 'selected' : '' }}>TABLETA</option>
                        <option value="TELEFONO MOVIL" {{ $equipo->tipo == 'TELEFONO MOVIL' ? 'selected' : '' }}>TELEFONO MOVIL</option>
                        <option value="UPS" {{ $equipo->tipo == 'UPS' ? 'selected' : '' }}>UPS</option>
                        <option value="WORKSTATION" {{ $equipo->tipo == 'WORKSTATION' ? 'selected' : '' }}>WORKSTATION</option>
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>
                

                <div class="col-md-3">
                    <label for="orden_compra" class="form-label">Orden De Compra:</label>
                    <input type="text" class="form-control" id="orden_compra" name="orden_compra" value="{{ $equipo->orden_compra }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="requisicion" class="form-label">Requisicion:</label>
                    <input type="text" class="form-control" id="requisicion" name="requisicion" value="{{ $equipo->requisicion }}" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" class="form-control" required>
                        <option value="Asignado" {{ $equipo->estado == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                        <option value="No asignado" {{ $equipo->estado == 'No asignado' ? 'selected' : '' }}>No asignado</option>
                        <option value="Baja" {{ $equipo->estado == 'Baja' ? 'selected' : '' }}>Baja</option>
                    </select>
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
