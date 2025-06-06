@extends('layouts.sidebar')
@section('title', 'Listado de Categorías')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Listado de Categorías</h1>

    <button class="btn btn-success mb-3" onclick="abrirModal()">Nueva Categoría</button>

    @if($categorias->count())
    <table class="table ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">DESCRIPCIÓN</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id_categoria }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="abrirModal('{{ $categoria->id_categoria }}', '{{ $categoria->descripcion }}')">
                        <i class='bx bxs-pencil'></i>
                    </button>
                    <form id="form-eliminar-{{ $categoria->id_categoria }}"
                        action="{{ route('home.categorias.destroy', $categoria->id_categoria) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion('{{ $categoria->id_categoria }}')">
                            <i class='bx bxs-trash'></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-warning">
        No hay categorías registradas.
    </div>
    @endif
    @if($errors->has('descripcion'))
    <script>
        window.errorMessage = 'El registro ya existe.';
    </script>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="categoriaModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="categoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formCategoria" method="POST" action="{{ route('home.categorias.store') }}">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoriaModalLabel">Crear Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <div id="error-descripcion" class="text-danger mt-1" style="display: none;">El campo descripción es obligatorio.</div>
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
        const form = document.getElementById('formCategoria');
        const methodInput = form.querySelector('input[name="_method"]');
        const modalTitle = document.getElementById('categoriaModalLabel');
        const descripcionInput = document.getElementById('descripcion');
        const categoriaIdInput = document.getElementById('categoria_id');

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

        const modal = new bootstrap.Modal(document.getElementById('categoriaModal'));
        modal.show();
        document.getElementById('formCategoria').addEventListener('submit', function(e) {
            const descripcion = document.getElementById('descripcion');
            const errorDiv = document.getElementById('error-descripcion');

            if (descripcion.value.trim() === '') {
                e.preventDefault(); // Evita el envío
                errorDiv.style.display = 'block';
                descripcion.classList.add('is-invalid');
            } else {
                errorDiv.style.display = 'none';
                descripcion.classList.remove('is-invalid');
            }
        });
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