@extends('layouts.admin')

@section('titulo', 'Perfil de Usuario')

@section('contenido')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Perfil de {{ $user->name }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('perfil.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <!-- Otros campos según sea necesario -->

                    <button type="submit" class="btn btn-primary mt-3">Actualizar Perfil</button>
                </form>
            </div>
        </div>
    </div>
@endsection
