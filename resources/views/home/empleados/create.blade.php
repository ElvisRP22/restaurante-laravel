@extends('layouts.sidebar')
@section('title', 'Registro')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Registro de Empleado') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-2">
                                <label for="dni" class="col-md-12 col-form-label ">DNI</label>
                                <div class="col-md-12">
                                    <input id="dni" type="text"
                                        class="form-control @error('dni') is-invalid @enderror" name="dni"
                                        value="{{ old('dni') }}" required>
                                    @error('dni')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="nombre" class="col-md-12 col-form-label ">Nombre</label>
                                <div class="col-md-12">
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre') }}" required>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="usuario" class="col-md-12 col-form-label ">Usuario</label>
                                <div class="col-md-12">
                                    <input id="usuario" type="text"
                                        class="form-control @error('usuario') is-invalid @enderror" name="usuario"
                                        value="{{ old('usuario') }}" required>
                                    @error('usuario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="clave" class="col-md-6 col-form-label ">Clave</label>
                                <label for="clave_confirmation" class="col-md-6 col-form-label ">Confirmar Clave</label>
                                <div class="col-md-6">
                                    <input id="clave" type="password"
                                        class="form-control @error('clave') is-invalid @enderror" name="clave" required>
                                    @error('clave')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="clave_confirmation" type="password" class="form-control"
                                        name="clave_confirmation" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="fecha_ingreso" class="col-md-6 col-form-label ">Fecha de Ingreso</label>
                                <label for="rol" class="col-md-6 col-form-label ">Rol</label>
                                <div class="col-md-6">
                                    <input id="fecha_ingreso" type="date"
                                        class="form-control @error('fecha_ingreso') is-invalid @enderror"
                                        name="fecha_ingreso" value="{{ old('fecha_ingreso', now()->format('Y-m-d')) }}"
                                        required>
                                    @error('fecha_ingreso')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <select name="rol" id="rol"
                                        class="form-control @error('rol') is-invalid @enderror" required>
                                        <option value="empleado" {{ old('rol') == 'empleado' ? 'selected' : '' }}>Empleado
                                        </option>
                                        <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador
                                        </option>
                                    </select>
                                    @error('rol')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
