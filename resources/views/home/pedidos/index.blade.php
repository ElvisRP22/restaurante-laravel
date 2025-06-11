@extends('layouts.sidebar')

@section('title', 'Listado de Pedidos')

@section('content')
<div class="container my-4">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 style="color: black; font-size: 2.5rem; font-weight: 600;">Pedidos Registrados</h2>
    <a href="{{ route('home.pedidos.create') }}" class="btn btn-primary">+ Nuevo Pedido</a>
</div>


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if ($pedidos->count())
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente ID</th>
                    <th>Empleado ID</th>
                    <th>Mesa ID</th>
                    <th>Total</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id_pedido }}</td>
                        <td>{{ $pedido->id_cliente }}</td>
                        <td>{{ $pedido->id_empleado }}</td>
                        <td>{{ $pedido->id_mesa }}</td>
                        <td>${{ number_format($pedido->total, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($pedido->fecha_registro)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('home.pedidos.edit', $pedido->id_pedido) }}" class="btn btn-sm btn-warning me-1" title="Editar">
                                <i class="bx bx-edit"></i>
                            </a>

                            <form action="{{ route('home.pedidos.destroy', $pedido->id_pedido) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar este pedido?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Eliminar" type="submit">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">No hay pedidos registrados.</div>
    @endif
</div>
@endsection