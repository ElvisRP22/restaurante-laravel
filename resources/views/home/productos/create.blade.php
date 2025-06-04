@extends('layouts.sidebar')
@section('title', 'Registrar Producto')
@section('content')
<div class="container mt-3">
    <p class="h2">Registrar Producto</p>
    <form id="formProducto" method="POST" action="{{ route('home.productos.store') }}" class="row" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="col-md-6 mb-3">
            <label for="id_categoria" class="form-label">Categoria:</label>
            <select name="id_categoria" class="form-select" id="id_categoria" required>
                <option disabled selected>--Seleccione una categoria--</option>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id_categoria }}">{{ $categoria->descripcion }}</option>
                @endforeach
            </select>
        </div>
        @error('categoria')
        <div class="col-md-6 mb-3">
            <div class="text-danger">{{ $message }}</div>
        </div>
        @enderror
        <div class="col-md-6 mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" class="form-select" id="estado">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="class-md-12 mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required>
        </div>
        @error('nombre')
        <div class="col-md-6 mb-3">
            <div class="text-danger">{{ $message }}</div>
        </div>
        @enderror
        <div class="class-md-12 mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción del producto"></textarea>
        </div>
        @error('descripcion')
        <div class="col-md-12 mb-3">
            <div class="text-danger">{{ $message }}</div>
        </div>
        @enderror
        <div class="col-md-4 mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" class="form-control" id="precio" name="precio" placeholder="20.00">
        </div>

        <!--Upload imagen-->
        <div class="col-md-8 mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>
        @error('precio')
        <div class="col-md-4 mb-3">
            <div class="text-danger">{{ $message }}</div>
        </div>
        @enderror
        @error('imagen')
        <div class="col-md-8 mb-3">
            <div class="text-danger">{{ $message }}</div>
        </div>
        @enderror
        <div class="d-flex justify-content-end">
            <a href="{{ route('home.productos.index') }}" class="btn btn-secondary mx-3">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@endsection