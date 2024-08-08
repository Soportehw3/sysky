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
                        <a href="{{ route('empleados.index') }}" class="small-box-footer">Más info <div
                                class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter danger">
                    <i class="fas fa-desktop"></i>
                    <span class="count-numbers">{{ $equipos_count }}</span>
                    <span class="count-name">Equipos</span>
                    <div class="info-footer">
                        <a href="{{ route('equipos.index') }}" class="small-box-footer">Más info <div
                                class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter success">
                    <i class="fas fa-keyboard"></i>
                    <span class="count-numbers">{{ $accesorios_count }}</span>
                    <span class="count-name">Accesorios</span>
                    <div class="info-footer">
                        <a href="{{ route('accesorios.index') }}" class="small-box-footer">Más info <div
                                class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card-counter primary">
                    <i class="fas fa-keyboard"></i>
                    <span class="count-numbers">{{ $equiposNoAsignados }}</span>
                    <span class="count-name">Equipos no asignados</span>
                    <div class="info-footer">
                        <a href="{{ route('equipos.index') }}" class="small-box-footer">Más info <div
                                class="fas fa-arrow-circle-right"></div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body row">
            <div class="col-lg-6">
                <div class="chart-container" style="position: relative; height:35vh; width:30vw">
                    <canvas id="equiposChart"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <h4>Últimas 10 Asignaciones de Equipos</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Equipo</th>
                            <th>Fecha Asignación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ultimasAsignaciones as $asignacion)
                            <tr>
                                <td>{{ $asignacion->empleado->nombre }} {{ $asignacion->empleado->apellidoP }} {{ $asignacion->empleado->apellidoM }}</td>
                                <td>{{ $asignacion->equipo->etiqueta_skytex }}</td>
                                <td>{{ $asignacion->fecha_asignacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <h4>Accesorios con Cantidad Baja</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Accesorio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accesoriosCantidadBaja as $accesorio)
                        <tr>
                            <td>{{ $accesorio->descripcion }}</td>
                            <td>{{ $accesorio->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

<div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('equiposChart').getContext('2d');
            var equiposChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: ['Asignados', 'No Asignados', 'Bajas'],
                    datasets: [{
                        label: 'Número de Equipos {{ $equipos_count }}',
                        data: [{{ $equiposAsignados }}, {{ $equiposNoAsignados }},
                            {{ $equiposBaja }}
                        ],
                        backgroundColor: [
                            'rgba(26, 188, 156, 1)',
                            'rgba(255, 195, 0, 1)',
                            'rgba(255, 87, 51, 1)'
                        ],
                        borderColor: [
                            'rgba(26, 188, 156, 1)',
                            'rgba(255, 195, 0, 1)',
                            'rgba(255, 87, 51, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
