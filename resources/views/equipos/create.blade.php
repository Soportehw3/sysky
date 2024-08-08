@extends('layouts.admin')

@section('titulo', 'Crear Nuevo Equipo')

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
            <form class="row g-3 needs-validation" novalidate action="{{ route('equipos.store') }}" method="POST">
                @csrf

                <div class="col-md-3">
                    <label for="numero_serie" class="form-label">Número de Serie:</label>
                    <input type="text" class="form-control" id="numero_serie" name="numero_serie" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="marca" class="form-label">Marca:</label>
                    <select id="marca" name="marca" class="form-control" required>
                        <option value="">Seleccione un empleado</option>
                        <option value="ACER"> ACER</option>
                        <option value="ADC"> ADC</option>
                        <option value="AOC"> AOC</option>
                        <option value="APPLE"> APPLE</option>
                        <option value="ASUS"> ASUS</option>
                        <option value="BAMBOO"> BAMBOO</option>
                        <option value="BENQ"> BENQ</option>
                        <option value="CANON">CANON</option>
                        <option value="CHINO"> CHINO</option>
                        <option value="DELL"> DELL</option>
                        <option value="EMACHINES"> EMACHINES</option>
                        <option value="ENSAMBLE"> ENSAMBLE</option>
                        <option value="EPSON"> EPSON</option>
                        <option value="GODEX"> GODEX</option>
                        <option value="HISENSE"> HISENSE</option>
                        <option value="HONEYWELL"> HONEYWELL</option>
                        <option value="HP"> HP</option>
                        <option value="HUAWEI"> HUAWEI</option>
                        <option value="INTOUS"> INTOUS</option>
                        <option value="KODAK">KODAK</option>
                        <option value="KYOCERA"> KYOCERA</option>
                        <option value="LENOVO"> LENOVO</option>
                        <option value="LG"> LG</option>
                        <option value="MITEL"> MITEL</option>
                        <option value="PANASONIC">PANASONIC</option>
                        <option value="PIXEL">PIXEL</option>
                        <option value="RASPBERRY"> RASPBERRY</option>
                        <option value="SAMSUNG"> SAMSUNG</option>
                        <option value="SANSUI"> SANSUI</option>
                        <option value="SATO"> SATO</option>
                        <option value="SIN MARCA"> SIN MARCA</option>
                        <option value="TAO">TAO</option>
                        <option value="TP-LINK"> TP-LINK</option>
                        <option value="TRIPPLITE"> TRIPPLITE</option>
                        <option value="TRUEMETER"> TRUEMETER</option>
                        <option value="UNITECH"> UNITECH</option>
                        <option value="VIEWSONIC"> VIEWSONIC</option>
                        <option value="VIISAN">VIISAN</option>
                        <option value="X-RITE"> X-RITE</option>
                        <option value="ZEBRA"> ZEBRA</option>
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
                    <label for="etiqueta_skytex" class="form-label">Etiqueta Skytex:</label>
                    <input type="text" class="form-control" id="etiqueta_skytex" name="etiqueta_skytex" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <select id="tipo" name="tipo" class="form-control" required>
                        <option value=""> Seleccione un tipo de equipo</option>
                        <option value="AIO-PCTOUCHPANEL"> AIO-PCTOUCHPANEL</option>
                        <option value="AP"> AP</option>
                        <option value="COMPUTADORA"> COMPUTADORA</option>
                        <option value="CTELEFONOPU"> TELEFONO</option>
                        <option value="CUENTAMETROS"> CUENTAMETROS</option>
                        <option value="ESCANER"> ESCANER</option>
                        <option value="ESPECTRO"> ESPECTRO</option>
                        <option value="iMAC"> iMAC</option>
                        <option value="LAPTOP"> LAPTOP</option>
                        <option value="LECTOR CB"> LECTOR CB</option>
                        <option value="LECTOR CD/DVD/BLUERAY"> LECTOR CD/DVD/BLUERAY</option>
                        <option value="Macbook Air"> Macbook Air</option>
                        <option value="MINIPC"> MINIPC</option>
                        <option value="MONITOR"> MONITOR</option>
                        <option value="MULTIFUN"> MULTIFUN</option>
                        <option value="PRENSA"> PRENSA</option>
                        <option value="PRINTER BN"> PRINTER BN</option>
                        <option value="PRINTER COLOR"> PRINTER COLOR</option>
                        <option value="PRINTER TERM"> PRINTER TERM</option>
                        <option value="PROYECTOR"> PROYECTOR</option>
                        <option value="RASPBERRY"> RASPBERRY</option>
                        <option value="Speaker/Mic Google"> Speaker/Mic Google</option>
                        <option value="SWITCH"> SWITCH</option>
                        <option value="TABLETA"> TABLETA</option>
                        <option value="TELEFONO MOVIL"> TELEFONO MOVIL</option>
                        <option value="UPS"> UPS</option>
                        <option value="WORKSTATION"> WORKSTATION</option>
                    </select>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="orden_compra" class="form-label">Orden De Compra:</label>
                    <input type="text" class="form-control" id="orden_compra" name="orden_compra" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="requisicion" class="form-label">Requisición:</label>
                    <input type="text" class="form-control" id="requisicion" name="requisicion" required>
                    <div class="valid-feedback">
                        Good!
                    </div>
                </div>

                <!-- Campo oculto para el estado por defecto -->
                <input type="hidden" name="estado" value="No asignado">

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>

            </form>
        </div>
    </div>

@endsection
