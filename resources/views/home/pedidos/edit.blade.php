@extends('layouts.sidebar')

@section('title', 'Editar Pedido')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-warning">Editar Pedido #{{ $pedido->id_pedido }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('home.pedidos.update', $pedido->id_pedido) }}" method="POST" class="card p-4 shadow-sm bg-light rounded">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_cliente" class="form-label">Cliente</label>
            <input type="number" class="form-control" id="id_cliente" name="id_cliente" value="{{ old('id_cliente', $pedido->id_cliente) }}" required>
        </div>

        <div class="mb-3">
            <label for="id_empleado" class="form-label">Empleado</label>
            <input type="number" class="form-control" id="id_empleado" name="id_empleado" value="{{ old('id_empleado', $pedido->id_empleado) }}" required>
        </div>

        <div class="mb-3">
            <label for="id_mesa" class="form-label">Mesa</label>
            <input type="number" class="form-control" id="id_mesa" name="id_mesa" value="{{ old('id_mesa', $pedido->id_mesa) }}" required>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" step="0.01" class="form-control" id="total" name="total" value="{{ old('total', $pedido->total) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_registro" class="form-label">Fecha Registro</label>
            <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" 
       value="{{ old('fecha_registro', optional($pedido->fecha_registro)->format('Y-m-d')) }}" 
       required>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Pedido</button>
        <a href="{{ route('home.pedidos.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
@endsection
 