@extends('layouts.sidebar')

@section('title', 'Crear Pedido')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Registrar nuevo pedido</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Corrige los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('home.pedidos.store') }}" method="POST" class="card p-4 shadow-sm bg-white rounded border">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select name="id_cliente" id="id_cliente" class="form-select" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}" {{ old('id_cliente') == $cliente->id_cliente ? 'selected' : '' }}>
                           {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="id_empleado" class="form-label">Empleado</label>
                <select name="id_empleado" id="id_empleado" class="form-select" required>
                    <option value="">Seleccione un empleado</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}" {{ old('id_empleado') == $empleado->id ? 'selected' : '' }}>
                            {{ $empleado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="id_mesa" class="form-label">Mesa</label>
                <select name="id_mesa" id="id_mesa" class="form-select" required>
                    <option value="">Seleccione una mesa</option>
                    @foreach ($mesas as $mesa)
                        <option value="{{ $mesa->id_mesa }}" {{ old('id_mesa') == $mesa->id_mesa ? 'selected' : '' }}>
                           Mesa #{{ $mesa->numero_mesa }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="id_estado" class="form-label">Estado</label>
                <select name="id_estado" id="id_estado" class="form-select" required>
                    <option value="">Seleccione un estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id_estado }}" {{ old('id_estado') == $estado->id_estado ? 'selected' : '' }}>
                           {{ $estado->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" step="0.01" class="form-control" id="total" name="total" value="{{ old('total') }}" placeholder="Monto total del pedido" required>
        </div>

        <div class="mb-3">
            <label for="fecha_registro" class="form-label">Fecha de Registro</label>
            <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" value="{{ old('fecha_registro') ?? date('Y-m-d') }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('home.pedidos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar Pedido</button>
        </div>
    </form>
</div>
@endsection
