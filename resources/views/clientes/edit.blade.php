@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar cliente</h2>
    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="{{ $cliente->nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="mesa" class="form-label">Mesa:</label>
            <input type="text" class="form-control" name="mesa" value="{{ $cliente->mesa }}" required>
        </div>
        <div class="mb-3">
            <label for="pedido" class="form-label">Pedido:</label>
            <input type="text" class="form-control" name="pedido" value="{{ $cliente->pedido }}" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" class="form-control">
                <option value="Pendiente" {{ $cliente->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="En proceso" {{ $cliente->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="Finalizado" {{ $cliente->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total (S/):</label>
            <input type="number" class="form-control" name="total" value="{{ $cliente->total }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
