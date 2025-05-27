@extends('layouts.app')
@section('title', 'Login')
<div class="container mt-5">
    <p class="h2 mb-4 text-center">Sistema de Pedidos - Administración</p>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="usuario" class="col-md-12 col-form-label">{{ __('Usuario') }}</label>

                            <div class="col-md-12">
                                <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" required autocomplete="usuario" autofocus>

                                @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="clave" class="col-md-4 col-form-label">{{ __('Clave') }}</label>

                            <div class="col-md-12">
                                <input id="clave" type="password" class="form-control @error('clave') is-invalid @enderror" name="clave" required autocomplete="current-password">

                                @error('clave')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('clave.request'))
                                    <a class="btn btn-link" href="{{ route('clave.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <!--Enlace a registrar nueevo usuario-->
                        <a class="btn btn-link" href="{{ route('register') }}">
                            Registro
                        </a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
