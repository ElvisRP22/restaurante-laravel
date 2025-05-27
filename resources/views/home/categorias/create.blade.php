@extends('layouts.app')

@section('title', 'Crear Categoria')

<div class="container mt-5">
    <h1 class="mb-4">Crear Categoria</h1>

    <form action="{{ route('home.categorias.store') }}" method="POST">
        @csrf
        @method('POST')

        <div class="row mb-3">
            <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripción</label>
            <div class="col-md-6">
                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required>
                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Crear
                </button>
            </div>
        </div>
    </form>
</div>