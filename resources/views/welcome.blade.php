<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pedidos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar fixed-top navbar-expand-md navbar-expand-sm bg-body-tertiary">
        <div class="container me-auto">
            <a class="navbar-brand" href="#">MiLogo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <form class="d-flex" role="search">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class='bx bxs-cart-alt'></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="max-height: 700px;">
                <img src="https://idiomas.proddigital.com.br/wp-content/uploads/sites/4/imagem-freepik-8-1024x683.jpg"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" style="max-height: 700px;">
                <img
                    src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/88/da/81/hummingbird-resort-executive.jpg?w=700&h=-1&s=1"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" style="max-height: 700px;">
                <img
                    src="https://images.rawpixel.com/image_social_landscape/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvMjY2LXBvbTk1NDItamotdG9uZy1sXzEuanBn.jpg?s=UORUJ8TA0l-6rR-2d9mXa068zoE6xB-etdRi5iZvAk0"
                    class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-fluid bg-warning py-5 text-center text-white">
        <div class="row">
            <div class="col-sm-12 col-md-4 ">
                <i class='bx bxs-bowl-hot bx-lg'></i>
                <p>Platillos diferentes<br>
                    Explora los nuevos platillos</p>
            </div>
            <div class="col-sm-12 col-md-4 ">
                <i class='bx bx-fork bx-lg'></i>
                <p>Cheff expertos<br>
                    Prueba nuevas experiencias</p>
            </div>
            <div class="col-sm-12 col-md-4 ">
                <i class='bx bxs-drink bx-lg'></i>
                <p>Bebidas tipicas<br>
                    Prueba tu bebida favorita</p>
            </div>
        </div>
    </div>

    <div class="container mt-5 text-center">
        <h1>Pedidos en el local</h1>
        <div class="input-group rounded">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
                <i class='bx bx-search-alt-2'></i>
            </span>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            @foreach($productos as $producto)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card mb-3">
                    <!-- Mostrar imagen desde /storage -->
                    <img src="{{ asset('storage/' . $producto->ruta_imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <div class="d-flex justify-content-start align-items-center">
                            <span class="h5 mb-0 me-5">${{ number_format($producto->precio, 2) }}</span>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                        <form action="{{ route('carrito.agregar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ encrypt($producto->id) }}">
                            <input type="hidden" name="nombre" value="{{ encrypt($producto->nombre) }}">
                            <input type="hidden" name="precio" value="{{ encrypt($producto->precio) }}">
                            <input type="number" name="cantidad" value="1" min="1" max="10" class="form-control form-control-sm w-50 me-2 d-inline">

                            <button type="submit" class="btn btn-warning btn-sm text-white" name="btnAccion" value="Agregar"
                                {{ $producto->estado ? '' : 'disabled' }}>
                                Agregar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>