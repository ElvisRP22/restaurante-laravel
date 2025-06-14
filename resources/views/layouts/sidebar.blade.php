<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nombre vista') | Sistema de Pedidos Restaurante</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @vite('resources/js/app.js')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar fijo -->
        <aside id="sidebar" class="expand">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i class='bx bx-menu'></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">MiLogo</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('home.productos.index') }}"
                        class="sidebar-link {{ request()->routeIs('home.productos.index') ? 'active' : '' }}">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span>Productos</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('home.categorias.index') }}"
                        class="sidebar-link {{ request()->routeIs('home.categorias.index') ? 'active' : '' }}">
                        <i class='bx bxs-category-alt'></i>
                        <span>Categorías</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('home.mesas.index') }}"
                        class="sidebar-link {{ request()->routeIs('home.mesas.index') ? 'active' : '' }}">
                        <i class='bx bx-table'></i>
                        <span>Mesas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('home.pedidos.index') }}"
                        class="sidebar-link {{ request()->routeIs('home.pedidos.index') ? 'active' : '' }}">
                        <i class='bx bxs-grid-alt'></i>
                        <span>Pedidos</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('home.empleados.index') }}"
                        class="sidebar-link {{ request()->routeIs('home.empleados.index') ? 'active' : '' }}">
                        <i class='bx bxs-user-badge'></i>
                        <span>Empleados</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('home.medios-de-pago.index') }}"
                        class="sidebar-link {{ request()->routeIs('home.medios-de-pago.index') ? 'active' : '' }}">
                        <i class='bx bx-money-withdraw'></i>
                        <span>Medios de pago</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer d-flex flex-column justify-content-center align-items-center text-center mb-3">
                <p style="color: white">{{ Auth::user()->nombre }}</p>
                <p style="color: white">{{ Auth::user()->rol }}</p>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">
                            <i class='bx bx-log-out'></i><span class="mx-2">Cerrar Sesión</span>
                        </button>
                    </form>
                @endauth
            </div>


        </aside>

        <!-- Contenido que cambia -->
        <div class="main p-3">
            @yield('content')
        </div>
        @if (session('info'))
            <script>
                window.errorMessage = '{{ session('info') }}';
            </script>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>

    @yield('scripts')
</body>

</html>
