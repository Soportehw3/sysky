<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }} - @yield('titulo')</title>


    <!-- Custom fonts for this template-->
    <link href="{{ asset('/libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


    <!-- Custom styles for this template-->
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('images/salidas/logo.png') }}">



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layouts.partials.sidebar')


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('perfil') }}">
                                        {{ __('Perfil') }}
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @include('layouts.partials.content')

            </div>
            <!-- End of Main Content -->


            @include('layouts.partials.footer')


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal Editar crear eliminar-->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">¡Correcto!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    @if ($message = Session::get('success'))
                        {{ $message }}
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "salir" a continuación si está listo para finalizar su sesión
                    actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap/js/bootstrap.min.js') }}"></script>


    <!-- Core plugin JavaScript-->

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('/libs/chart.js/Chart.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/libs/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>






</body>

</html>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<!-- Include Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script to trigger the modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (Session::has('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif
    });
</script>


<script>
    var $ = jQuery;

    $(document).ready(function() {
        $('#empleado_id').select2({
            theme: "bootstrap-5",
            placeholder: 'Seleccione un empleado',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            allowClear: true
        }).on('select2:open', function() {
            // Auto-focus on the search field
            setTimeout(function() {
                document.querySelector(".select2-container--open .select2-search__field")
                    .focus()
            }, 0);
        });
    });

    $(document).ready(function() {
        $('#empresa_id').select2({
            theme: "bootstrap-5",
            placeholder: 'Seleccione una empresa',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            allowClear: true
        }).on('select2:open', function() {
            // Auto-focus on the search field
            setTimeout(function() {
                document.querySelector(".select2-container--open .select2-search__field")
                    .focus()
            }, 0);
        });
    });



    $(document).ready(function() {
        $('#marca_id').select2({
            theme: "bootstrap-5",
            placeholder: 'Seleccione una Marca',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            allowClear: true
        }).on('select2:open', function() {
            // Auto-focus on the search field
            setTimeout(function() {
                document.querySelector(".select2-container--open .select2-search__field")
                    .focus()
            }, 0);
        });
    });

    $(document).ready(function() {
        $('#tipo_equipo_id').select2({
            theme: "bootstrap-5",
            placeholder: 'Seleccione un Tipo de Equipo  ',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            allowClear: true
        }).on('select2:open', function() {
            // Auto-focus on the search field
            setTimeout(function() {
                document.querySelector(".select2-container--open .select2-search__field")
                    .focus()
            }, 0);
        });
    });


    $(document).ready(function() {
        $('#equipo_id').select2({
            theme: "bootstrap-5",
            placeholder: 'Seleccione un equipo',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            allowClear: true
        }).on('select2:open', function() {
            // Auto-focus on the search field
            setTimeout(function() {
                document.querySelector(".select2-container--open .select2-search__field")
                    .focus()
            }, 0);
        });
    });

    $(document).ready(function() {
        $('#accesorio_id').select2({
            theme: "bootstrap-5",
            placeholder: 'Seleccione un accesorio',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            allowClear: true
        }).on('select2:open', function() {
            // Auto-focus on the search field
            setTimeout(function() {
                document.querySelector(".select2-container--open .select2-search__field")
                    .focus()
            }, 0);
        });
    });

    /*Datapiker para fechas
     $('#datepicker').datepicker({
         uiLibrary: 'bootstrap5',
         iconsLibrary: 'fontawesome'
     });
     
     $('#fecha_asignacion').datepicker({
         uiLibrary: 'bootstrap5',
         iconsLibrary: 'fontawesome'
     });*/

    $(document).ready(function() {
        $('#marca').select2({
            theme: "bootstrap-5",
            placeholder: 'Seleccione una marca',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            allowClear: true
        }).on('select2:open', function() {
            // Auto-focus on the search field
            setTimeout(function() {
                document.querySelector(".select2-container--open .select2-search__field")
                    .focus()
            }, 0);
        });
    });
</script>

<script>
    //Para poner la fecha en automatico en asignacion de equipos 
    /*document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = ("0" + today.getDate()).slice(-2); // Agrega un cero delante si es necesario
        var month = ("0" + (today.getMonth() + 1)).slice(-2); // Los meses empiezan desde 0
        var year = today.getFullYear();

        var formattedDate = year + "-" + month + "-" + day;
        document.getElementById('datepicker').value = formattedDate;
    });
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = ("0" + today.getDate()).slice(-2); // Agrega un cero delante si es necesario
        var month = ("0" + (today.getMonth() + 1)).slice(-2); // Los meses empiezan desde 0
        var year = today.getFullYear();

        var formattedDate = year + "-" + month + "-" + day;
        document.getElementById('fecha_asignacion').value = formattedDate;
    });*/
</script>
<style>
    .badge-asignado {
        background-color: green;
        color: white;
    }

    .badge-baja {
        background-color: red;
        color: white;
    }

    .badge-default {
        background-color: gray;
        color: white;
    }
</style>
