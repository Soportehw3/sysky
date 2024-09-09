@extends('layouts.app')

@section('content')

<!-- Custom fonts for this template-->
<link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

<div class="container" class="bg-gradient-primary">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- Image Column -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="{{ asset('libs/img/pngegg.png') }}" alt="Login Image" class="img-fluid">
                        </div>
                        <!-- Form Column -->
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                </div>
                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo Electronico...">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contrasña">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customCheck">Recordarme</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Iniciar Sesion') }}
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                        <a class="small" href="{{ route('password.request') }}">{{ __('Olvidaste Tu contraseña?') }}</a>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Crear una cuenta!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('libs/chart.js/Chart.min.js') }}"></script>

@endsection
