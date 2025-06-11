@extends('layouts.sidebar')
@section('title', 'Productos')
@section('content')
    <div class="container mt-2">
        <p class="h2 mb-3">Listado de Productos</p>
        <div class="row">
            <div class="col-md-8">
                <a href="{{ route('home.productos.create') }}" class="btn btn-success mb-3">Nuevo Producto</a>
            </div>
            <div class="col-md-4 text-end">
                <form action="{{ route('home.productos.index') }}" method="GET" class="row">
                    <input type="search" class="form-control" placeholder="Ingresa una descripción y presiona enter"
                        value="{{ $busqueda }}" name="busqueda">
                </form>
            </div>
        </div>

        @if ($productos->count())
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
                            <td>{{ $producto->id_producto }}</td>
                            <td>{{ $producto->categoria->descripcion ?? 'Sin categoría' }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->precio }}</td>
                            <td>
                                <img src="{{ asset('storage/imagenes/' . $producto->imagen) }}" alt="producto"
                                    class="img-fluid" width="50" height="50">
                            </td>
                            <td><span
                                    class="badge {{ $producto->estado ? 'bg-success' : 'bg-danger' }}">{{ $producto->estado ? 'Disponible' : 'No Disponible' }}</span>
                            </td>
                            <td>
                                <a href="{{ route('home.productos.edit', $producto->id_producto) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class='bx bxs-pencil'></i>
                                </a>
                                <form id="form-eliminar-{{ $producto->id_producto }}"
                                    action="{{ route('home.productos.destroy', $producto->id_producto) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmarEliminacion('{{ $producto->id_producto }}')">
                                        <i class='bx bxs-trash'></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--Crear paginacion-->
            {{ $productos->links() }}
        @else
            <div class="alert alert-warning">
                No hay productos registrados.
            </div>
        @endif
        @if (session('success'))
            <script>
                window.successMessage = '{{ session('success') }}';
            </script>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Estás seguro de eliminar este producto?',
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
@endsection
