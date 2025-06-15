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
    <style>
        .scroll-container {
            overflow-x: auto;
            white-space: nowrap;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
            /* Oculta scrollbar en WebKit */
        }

        .btn-carousel {
            scroll-snap-align: start;
            margin: 0.5rem;
            display: inline-block;
        }
    </style>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-md navbar-expand-sm bg-body-tertiary">
        <div class="container me-auto">
            <a class="navbar-brand" href="#">MiLogo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex" role="search">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class='bx bxs-cart-alt'>Mi pedido</i>
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
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/88/da/81/hummingbird-resort-executive.jpg?w=700&h=-1&s=1"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" style="max-height: 700px;">
                <img src="https://images.rawpixel.com/image_social_landscape/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvMjY2LXBvbTk1NDItamotdG9uZy1sXzEuanBn.jpg?s=UORUJ8TA0l-6rR-2d9mXa068zoE6xB-etdRi5iZvAk0"
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
        <div class="input-group rounded mb-3">
            <input type="search" class="form-control rounded" placeholder="Buscar platillo..." aria-label="Buscar"
                aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
                <i class='bx bx-search-alt-2'></i>
            </span>
        </div>

        <div class="scroll-container d-flex mt-3">
            <button type="button" class="btn btn-outline-warning btn-carousel filter-btn"
                data-filter="0">Todos</button>
            @foreach ($categorias as $categoria)
                <button type="button" class="btn btn-outline-warning btn-carousel filter-btn"
                    data-filter="{{ $categoria->id_categoria }}">{{ $categoria->descripcion }}</button>
            @endforeach
        </div>
        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <div class="row mt-3" id="productos">
            @foreach ($productos as $producto)
                <div class="col-sm-6 col-md-4 col-lg-3 producto" data-category="{{ $producto->id_categoria }}">
                    <div class="card mb-3">
                        <img src="{{ asset('storage/imagenes/' . $producto->imagen) }}" class="card-img-top"
                            alt="{{ $producto->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ $producto->descripcion }}</p>
                        </div>
                        <div class="card-footer bg-light">
                            <form action="{{ route('add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $producto->id_producto }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-dark">${{ number_format($producto->precio, 2) }}</span>
                                    <input type="number" name="cantidad" value="1" min="1"
                                        max="10" class="form-control w-50 ms-2">
                                </div>
                                <button type="submit" class="btn btn-warning text-white w-100 mt-2"
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

    <button type="button" class="btn btn-success position-fixed bottom-0 end-0 m-4" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        <i class='bx bxs-cart-alt'></i>Mi Pedido<span>{{ Cart::getContent()->count() }}</span>
    </button>


    <!-- Modal del carrito -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mi Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    @if (Cart::getContent()->count())
                        <table>
                            <thead>
                                <th>Producto</th>
                                <th>Cant</th>
                                <th>Precio</th>
                                <th>Importe</th>
                            </thead>
                            <tbody>
                                @foreach (Cart::getContent() as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 2) }}</td>
                                        <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                                        <td>
                                            <form action="{{ route('removeitem') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit"
                                                    class="btn btn-link btn-sm-text-danger">x</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No has agregado productos</p>
                    @endif
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- JS de filtrado -->
    <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const filtro = btn.getAttribute('data-filter');
                document.querySelectorAll('.producto').forEach(producto => {
                    const categoria = producto.getAttribute('data-category');
                    producto.style.display = (filtro === "0" || filtro === categoria) ? "block" :
                        "none";
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
