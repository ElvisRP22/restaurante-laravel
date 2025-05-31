@extends('layouts.sidebar')
@section('title', 'Productos')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Listado de Productos</h1>

    <button class="btn btn-success mb-3" onclick="abrirModal()">Nuevo Producto</button>

    @if($productos->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>IDENTIFICADOR</th>
                <th>CATEGORIA</th>
                <th>NOMBRE</th>
                <th>DESCRIPCIÓN</th>
                <th>PRECIO</th>
                <th>IMAGEN</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id_producto }}</td>
                <td>{{ $producto->$categoria->descripcion }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio }}</td>
                <th>
                    <img src="{{ asset('storage/images/' . $producto->imagen) }}" alt="producto" class="img-fluid">
                </th>
                <td>{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="abrirModal('{{ $producto->id_producto }}', '{{ $producto->descripcion }}')">
                        <i class='bx bxs-pencil'></i> Editar
                    </button>
                    <form id="form-eliminar-{{ $categoria->id_categoria }}"
                        action="{{ route('home.categorias.destroy', $categoria->id_categoria) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion('{{ $categoria->id_categoria }}')">
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

<!-- Modal -->
<div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formProducto" method="POST" action="{{ route('home.productos.store') }}">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoriaModalLabel">Crear Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <select name="categoria" class="form-select" required>
                            <option disabled selected>Seleccione una categoria</option>
                            <option value="">
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción del producto"></textarea>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="20.00">
                    </div>
                    <!--Upload imagen-->
                    <div class="mb-3 col-md-4">
                        <label for="imagen" class="form-label">Imagen:</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="estado" class="form-label">Estado:</label>
                        <select name="estado" class="form-select" id="estado">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <input type="hidden" id="categoria_id" name="categoria_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
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