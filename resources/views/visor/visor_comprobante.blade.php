<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visor de Cocina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-4">
    <h1 class="mb-4">📺 Visor de comprobantes</h1>

    <div class="row">

        @forelse ($comprobantes as $comproabnte)
        <div class="col-md-4">
            <div class="card text-dark mb-3">

                <div class="card-body">
                    <p class="card-text">
                        <strong>Mesa:</strong> {{ $pedido->mesa }} <br>
                        <strong>Hora:</strong> {{ \Carbon\Carbon::parse($comproabnte->fecha)->format('H:i:s') }}
                    </p>

                    <form method="POST" action="{{ route('comprobante.marcarListo', $comprobante->id) }}">
                        @csrf
                        <button class="btn btn-success w-100">Marcar como Listo</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        0
21        <p>No hay comprobantes pendientes</p>
        @endforelse
    </div>
</div>

</body>
</html>
