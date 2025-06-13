@extends('layouts.sidebar')
@section('title', 'Administrar Medios de Pago')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Listado de Medios de Pago</h1>

    <button class="btn btn-success mb-3" onclick="abrirModal()">Nuevo</button>

    @if($medios->count())
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">DESCRIPCIÓN</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medios as $medio)
            <tr>
                <td>{{ $medio->id_medio_pago }}</td>
                <td>{{ $medio->descripcion }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="abrirModal('{{ $medio->id_medio_pago }}', '{{ $medio->descripcion }}')">
                        <i class='bx bxs-pencil'></i>
                    </button>
                    <form id="form-eliminar"
                        action="{{ route('home.medios-de-pago.destroy', $medio->id_medio_pago) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion()">
                            <i class='bx bxs-trash'></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">
        No hay medios de pago registrados.
    </div>
    @endif
    @if($errors->has('descripcion'))
    <script>
        window.errorMessage = 'El medio de pago ya existe.';
    </script>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="medioModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="medioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formMedio" method="POST" action="{{ route('home.medios-de-pago.store') }}">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="medioModalLabel">Crear Medio de Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <div id="error-descripcion" class="text-danger mt-1" style="display: none;">Ingresa una descripción valida.</div>
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
    function abrirModal(id, descripcion = '') {
        const form = document.getElementById('formMedio');
        const methodInput = form.querySelector('input[name="_method"]');
        const modalTitle = document.getElementById('medioModalLabel');
        const descripcionInput = document.getElementById('descripcion');
        
        if (id) {
            // Modo edición
            modalTitle.textContent = 'Editar Medio de Pago';
            descripcionInput.value = descripcion;
            form.action = `/home/medios-de-pago/${id}`;
            methodInput.value = 'PUT';
        } else {
            // Modo creación
            modalTitle.textContent = 'Crear Medio de Pago';
            descripcionInput.value = '';
            form.action = `{{ route('home.medios-de-pago.store') }}`;
        }

        const modal = new bootstrap.Modal(document.getElementById('medioModal'));
        modal.show();
        document.getElementById('formMedio').addEventListener('submit', function(e) {
            const descripcion = document.getElementById('descripcion');
            const errorDiv = document.getElementById('error-descripcion');;

            if (descripcion.value.trim() === '' || capacidad.value.trim() === '') {
                e.preventDefault(); // Evita el envío
                errorDiv.style.display = 'block';
                descripcion.classList.add('is-invalid');
            } else {
                errorDiv.style.display = 'none';;
                descripcion.classList.remove('is-invalid');
            }
        });
    }

    function confirmarEliminacion() {
        Swal.fire({
            title: '¿Estás seguro de eliminar el medio de pago?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-eliminar').submit();
            }
        });
    }
</script>