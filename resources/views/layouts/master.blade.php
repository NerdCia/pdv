<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="/img/logo.png" type="image/x-icon">
  <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.min.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>
  <header>
    <div class="container bg-white d-grid gap-3 p-3 my-3 align-items-center rounded-pill"
      style="grid-template-columns: 1fr 2fr;">
      <div class="d-flex align-items-center mb-lg-0">
        <a href="{{ route('components.dashboard') }}" class="text-body-emphasis text-decoration-none fw-bold fs-5">
          <img src="/img/logo.png" class="rounded-circle me-2 shadow" alt="Logo" width="40">
          Nerd<span style="color: #ed3237">&amp;</span>Cia
        </a>
      </div>
      <div class="d-flex align-items-center">
        <form class="w-100 me-3" role="search">
          @csrf
          <div class="input-group">
            <input type="search" class="form-control rounded-start-pill shadow" placeholder="Pesquisar..."
              aria-label="Search">
            <button class="btn btn-danger rounded-end-pill"><i class="bi bi-search"></i></button>
          </div>
        </form>

        @auth
        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/img/logo.png" alt="mdo" width="36" class="rounded-circle shadow">
          </a>
          <ul class="dropdown-menu text-small" style="">
            <li><a class="dropdown-item" href="#">Configurações</a></li>
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('form.logout') }}">Sair</a></li>
          </ul>
        </div>
        @else
        <div class="flex-shrink-0">
          <a class="btn btn-danger rounded-pill px-4 me-2" href="{{ route('form.login') }}">Login</a>
        </div>
        @endauth
        
      </div>
    </div>
  </header>
  <div class="row container-fluid m-0 w-100">
    <div class="col-2">
      <ul class="nav flex-column text-center bg-white mx-auto my-3 col-12 col-lg-10 rounded-5 py-4 shadow"
        id="sidebar">
        <li class="nav-item my-2">
          <a class="nav-link text-secondary px-0 py-3 rounded-4 text-uppercase" href="{{ route('components.dashboard') }}">
            <i class="bi bi-speedometer d-block fs-5"></i>
            <small class="d-none d-lg-block">Painel</small>
          </a>
        </li>
        <li class="nav-item my-2">
          <a class="nav-link text-secondary px-0 py-3 rounded-4 text-uppercase" href="{{ route('components.sales') }}">
            <i class="bi bi-cart d-block fs-5"></i>
            <small class="d-none d-lg-block">Vendas</small>
          </a>
        </li>
        <li class="nav-item my-2">
          <a class="nav-link text-secondary px-0 py-3 rounded-4 text-uppercase"
            href="{{ route('components.products') }}">
            <i class="bi bi-bag d-block fs-5"></i>
            <small class="d-none d-lg-block">Produtos</small>
          </a>
        </li>
        <li class="nav-item my-2">
          <a class="nav-link text-secondary px-0 py-3 rounded-4 text-uppercase" href="#">
            <i class="bi bi-gear d-block fs-5"></i>
            <small class="d-none d-lg-block">Configurações</small>
          </a>
        </li>
      </ul>
    </div>
    <div class="col">
      @yield('content')
    </div>
  </div>

  <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/js/jquery-3.7.1.min.js"></script>
  <script src="/js/script.js"></script>
  @stack('graphics')
</body>

</html>
