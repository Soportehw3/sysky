@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('contenido')

    <div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="card-counter info">
                    <i class="fas fa-user"></i>
                    <span class="count-numbers">{{ $empleados_count }}</span>
                    <span class="count-name">Empleados Registrados</span>
                    <div class="info-footer">
                        <a href="{{ route('empleados.index') }}" class="small-box-footer">Más info <div class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter danger">
                    <i class="fas fa-desktop"></i>
                    <span class="count-numbers">{{ $equipos_count }}</span>
                    <span class="count-name">Equipos</span>
                    <div class="info-footer">
                        <a href="{{ route('equipos.index') }}" class="small-box-footer">Más info <div class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter success">
                    <i class="fas fa-keyboard"></i>
                    <span class="count-numbers">{{ $accesorios_count }}</span>
                    <span class="count-name">Accesorios</span>
                    <div class="info-footer">
                        <a href="{{ route('accesorios.index') }}" class="small-box-footer">Más info <div class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter primary">
                    <i class="fas fa-keyboard"></i>
                    <span class="count-numbers">{{ $accesorios_count }}</span>
                    <span class="count-name">Accesorios</span>
                    <div class="info-footer">
                        <a href="{{ route('accesorios.index') }}" class="small-box-footer">Más info <div class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.row -->
    </div>
@endsection
