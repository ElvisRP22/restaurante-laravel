@extends('layouts.sidebar')
@section('title', 'Lista de Empleados')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Listado Empleados</h1>
        <div class="row">
            <div class="col-md-8">
                <a href="{{ route('home.empleados.create') }}" class="btn btn-success mb-3">
                    Nuevo Empleado
                </a>
            </div>
            <div class="col-md-4 text-end">
                <input type="search" class="form-control" placeholder="Buscar empleado...">
            </div>
        </div>

        @if ($empleados->count())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DNI</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">ROL</th>
                        <th scope="col">USUARIO</th>
                        <th scope="col">FECHA INGRESO</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td scope="col">{{ $empleado->id_empleado }}</td>
                            <td>{{ $empleado->dni }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->rol }}</td>
                            <td>{{ $empleado->usuario }}</td>
                            <td>{{ $empleado->fecha_ingreso }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                No hay empleados registrados.
            </div>
        @endif

    </div>
@endsection
@section('scripts')
    <script>
        
    </script>
@endsection