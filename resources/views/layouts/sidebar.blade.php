<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Nombre vista') | Sistema de Pedidos Restaurante</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar fijo -->
    <aside id="sidebar">
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
          <a href="#" class="sidebar-link">
            <i class='bx bxs-shopping-bag-alt'></i>
            <span>Productos</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class='bx bxs-grid-alt'></i>
            <span>Pedidos</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="{{ route('home.categorias.index') }}" class="sidebar-link">
            <i class='bx bxs-category-alt'></i>
            <span>Categorías</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class='bx bxs-user-badge'></i>
            <span>Empleados</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer d-flex justify-content-center mb-2">
        @auth
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
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
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>