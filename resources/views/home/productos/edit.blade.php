@extends('layouts.sidebar')
@section('title', 'Editar Producto')
@section('content')
    <div class="container mt-3">
        <p class="h2">Editar Producto</p>
        <form id="formProducto" method="POST" action="{{ route('home.productos.update', $producto->id_producto) }}"
            class="row" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-6 mb-3">
                <label for="id_categoria" class="form-label">Categoria:</label>
                <select name="id_categoria" class="form-select" id="id_categoria" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}"
                            {{ $producto->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                            {{ $categoria->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('id_categoria')
                <div class="col-md-6 mb-3">
                    <div class="text-danger">{{ $message }}</div>
                </div>
            @enderror
            <div class="col-md-6 mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select name="estado" class="form-select" id="estado">
                    <option value="1" {{ $producto->estado ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $producto->estado ? '' : 'selected' }}>Inactivo</option>
                </select>
            </div>
            <div class="class-md-12 mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}"
                    placeholder="Nombre del producto" required>
            </div>
            @error('nombre')
                <div class="col-md-6 mb-3">
                    <div class="text-danger">{{ $message }}</div>
                </div>
            @enderror
            <div class="class-md-12 mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                    placeholder="Descripción del producto">{{ $producto->descripcion }}</textarea>
            </div>
            @error('descripcion')
                <div class="col-md-12 mb-3">
                    <div class="text-danger">{{ $message }}</div>
                </div>
            @enderror
            <div class="col-md-4 mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" value="{{ $producto->precio }}"
                    placeholder="20.00">
            </div>
            <div class="col-md-8 mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="form-label">Imagen Actual:</label><br>
                <img src="{{ asset('storage/imagenes/' . $producto->imagen) }}" alt="Imagen del producto"
                    style="max-height: 150px;">
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
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
