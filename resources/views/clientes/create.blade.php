@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar nuevo cliente</h2>
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="mesa" class="form-label">Mesa:</label>
            <input type="text" class="form-control" name="mesa" required>
        </div>
        <div class="mb-3">
            <label for="pedido" class="form-label">Pedido:</label>
            <input type="text" class="form-control" name="pedido" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" class="form-control">
                <option value="Pendiente">Pendiente</option>
                <option value="En proceso">En proceso</option>
                <option value="Finalizado">Finalizado</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total (S/):</label>
            <input type="number" class="form-control" name="total" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
