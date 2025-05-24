@extends('layouts.app') {{-- Extiende una plantilla base si la tienes --}}

@section('title', 'Listado de categorias')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Listado de Categorias</h1>

    {{-- Botón para crear nueva categoria --}}
    <a href="{{ route('categorias.create') }}" class="btn btn-success mb-3">+ Nueva Categoria</a>

    {{-- Verifica si hay categorias --}}
    @if($categorias->count())
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id_categoria }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>
                            <a href="{{ route('categorias.show', $categoria->id_categoria) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" class="btn btn-primary btn-sm">Editar</a>

                            <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">
            No hay categorias registradas.
        </div>
    @endif
</div>
@endsection
