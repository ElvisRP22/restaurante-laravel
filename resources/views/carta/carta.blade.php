<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta del Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1>Carta de Mesa {{ $mesa }}</h1>
    
    <div class="row">
        @foreach ($productos as $producto)
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text"><strong>S/ {{ $producto->precio }}</strong></p>
                    @if (session('cliente_id'))
                    <form method="POST" action="{{ route('pedidos.store') }}">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                        <input type="hidden" name="mesa" value="{{ $mesa }}">
                        <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2" required>
                        <button type="submit" class="btn btn-success w-100">Pedir</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



</body>
</html>