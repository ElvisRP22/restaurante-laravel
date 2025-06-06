@extends('layouts.sidebar')
@section('title', 'Administrar Mesas')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Listado de Mesas</h1>

    <button class="btn btn-success mb-3" onclick="abrirModal()">Nueva Mesa</button>

    @if($mesas->count())
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NUMERO</th>
                <th scope="col">CAPACIDAD</th>
                <th scope="col">ESTADO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mesas as $mesa)
            <tr>
                <td>{{ $mesa->id_mesa }}</td>
                <td>{{ $mesa->numero_mesa }}</td>
                <td>{{ $mesa->capacidad }}</td>
                <td>{{ $mesa->estado ? 'Libre' : 'Ocupada' }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="abrirModal('{{ $mesa->id_mesa }}', '{{ $mesa->numero_mesa }}', '{{ $mesa->capacidad }}')">
                        <i class='bx bxs-pencil'></i>
                    </button>
                    <form id="form-eliminar-{{ $mesa->id_mesa }}"
                        action="{{ route('home.mesas.destroy', $mesa->id_mesa) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion('{{ $mesa->id_mesa }}')">
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
        No hay mesas registradas.
    </div>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="mesaModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="mesaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formMesa" method="POST" action="{{ route('home.mesas.store') }}">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mesaModalLabel">Crear Mesa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="numero_mesa" class="form-label">Numero de Mesa</label>
                        <input type="number" class="form-control" id="numero_mesa" name="numero_mesa" required>
                    </div>
                    <div id="error-numero-mesa" class="text-danger mt-1" style="display: none;">El numero de mesa es obligatorio.</div>
                    @error('numero_mesa')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="capacidad" class="form-label">Capacidad</label>
                        <input type="number" class="form-control" id="capacidad" name="capacidad" required>
                    </div>
                    <div id="error-capacidad" class="text-danger mt-1" style="display: none;">La capacidad es obligatoria.</div>
                    @error('capacidad')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
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
    function abrirModal(id = null, numero_mesa = '', capacidad = '') {
        const form = document.getElementById('formMesa');
        const methodInput = form.querySelector('input[name="_method"]');
        const modalTitle = document.getElementById('mesaModalLabel');
        const numero_mesaInput = document.getElementById('numero_mesa');
        const capacidadInput = document.getElementById('capacidad');
        
        if (id) {
            // Modo edición
            modalTitle.textContent = 'Editar Mesa';
            numero_mesaInput.value = numero_mesa;
            capacidadInput.value = capacidad;
            form.action = `/home/mesas/${id}`;
            methodInput.value = 'PUT';
        } else {
            // Modo creación
            modalTitle.textContent = 'Crear Mesa';
            numero_mesaInput.value = '';
            capacidadInput.value = '';
            form.action = `{{ route('home.mesas.store') }}`;
        }

        const modal = new bootstrap.Modal(document.getElementById('mesaModal'));
        modal.show();
        document.getElementById('formMesa').addEventListener('submit', function(e) {
            const numero_mesa = document.getElementById('numero_mesa');
            const capacidad = document.getElementById('capacidad');
            const errorDiv = document.getElementById('error-numero-mesa');
            const errorDiv2 = document.getElementById('error-capacidad');

            if (numero_mesa.value.trim() === '' || capacidad.value.trim() === '') {
                e.preventDefault(); // Evita el envío
                errorDiv.style.display = 'block';
                errorDiv2.style.display = 'block';
                numero_mesa.classList.add('is-invalid');
                capacidad.classList.add('is-invalid');
            } else {
                errorDiv.style.display = 'none';
                errorDiv2.style.display = 'none';
                numero_mesa.classList.remove('is-invalid');
                capacidad.classList.remove('is-invalid');
            }
        });
    }

    function confirmarEliminacion(id) {
        Swal.fire({
            title: '¿Estás seguro de eliminar esta mesa?',
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