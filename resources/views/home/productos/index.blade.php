@extends('layouts.sidebar')
@section('title', 'Productos')
@section('content')
<div class="container mt-2">
    <p class="h2 mb-3">Listado de Productos</p>
    <a href="{{ route('home.productos.create') }}" class="btn btn-success mb-3">Nuevo Producto</a>

    @if($productos->count())
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">DESCRIPCIÓN</th>
                <th scope="col">PRECIO</th>
                <th scope="col">IMAGEN</th>
                <th scope="col">ESTADO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td scope="col">{{ $producto->id_producto }}</td>
                <td>{{ $producto->categoria->descripcion ?? 'Sin categoría' }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio }}</td>
                <th>
                    <img src="{{ asset('storage/imagenes/' . $producto->imagen) }}" alt="producto" class="img-fluid" width="50" height="50">
                </th>
                <td>{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="abrirModal('{{ $producto->id_producto }}', '{{ $producto->descripcion }}')">
                        <i class='bx bxs-pencil'></i> Editar
                    </button>
                    <form id="form-eliminar-{{ $producto->id_producto }}"
                        action="{{ route('home.productos.destroy', $producto->id_producto) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion('{{ $producto->id_producto }}')">
                            <i class='bx bxs-trash'></i> Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-warning">
        No hay productos registrados.
    </div>
    @endif
</div>
@endsection
<script>
    function abrirModal(id = null, descripcion = '') {
        const form = document.getElementById('formProducto');
        const methodInput = form.querySelector('input[name="_method"]');
        const modalTitle = document.getElementById('categoriaModalLabel');
        const descripcionInput = document.getElementById('descripcion');
        const categoriaIdInput = document.getElementById('categoria_id');
        /*
        if (id) {
            // Modo edición
            modalTitle.textContent = 'Editar Categoría';
            descripcionInput.value = descripcion;
            categoriaIdInput.value = id;
            form.action = `/home/categorias/${id}`;
            methodInput.value = 'PUT';
        } else {
            // Modo creación
            modalTitle.textContent = 'Crear Categoría';
            descripcionInput.value = '';
            categoriaIdInput.value = '';
            form.action = `{{ route('home.categorias.store') }}`;
            methodInput.value = 'POST';
        }
        */
        const modal = new bootstrap.Modal(document.getElementById('productoModal'));
        modal.show();
    }

    function confirmarEliminacion(id) {
        Swal.fire({
            title: '¿Estás seguro de eliminar esta categoría?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-eliminar-' + id).submit();
            }
        });
    }
</script>