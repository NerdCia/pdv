<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{ url("storage/{$logo}") }}" type="image/x-icon">
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
  <header>
    <div class="container bg-white d-grid p-3 my-3 align-items-center rounded-pill"
      style="grid-template-columns: 1fr 2fr;">
      <div class="d-flex align-items-center">
        <a href="{{ route('components.dashboard') }}"
          class="text-body-emphasis text-decoration-none d-inline-flex align-items-center">
          @if (isset($logo) && Storage::get($logo))
            <img src="{{ url("storage/{$logo}") }}" class="rounded-circle me-2" alt="Logo" width="40">
          @else
            <img src="{{ asset('img/logo.png') }}" class="rounded-circle me-2" alt="Logo" width="40">
          @endif
          @if ($company_name)
            <span class="d-none d-sm-inline fw-bold fs-5">{{ $company_name }}</span>
          @else
            <span class="d-none d-sm-inline fw-bold fs-5">Nerd<span style="color: #ed3237">&amp;</span>Cia</span>
          @endif
        </a>
      </div>
      <div class="d-flex align-items-center">
        <form class="w-100 me-3" role="search" action="{{ route('components.products') }}" method="GET"
          enctype="multipart/form-data">
          @csrf
          <div class="input-group">
            <input type="search" class="form-control rounded-start-pill shadow" name="searchProducts"
              id="searchProducts" placeholder="Pesquisar..." aria-label="Search">
            <button type="submit" class="btn btn-danger rounded-end-pill"><i class="bi bi-search"></i></button>
          </div>
        </form>

        @auth
          <div class="flex-shrink-0 dropdown">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle fs-4 align-middle text-secondary"></i>
            </a>
            <ul class="dropdown-menu text-small" style="">
              @can('all')
                <li><a class="dropdown-item" href="{{ route('components.configurations') }}">Configurações</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
              @endcan
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
  <div class="row container m-auto">
    <div class="col-sm-3 col-md-2">
      <ul
        class="nav justify-content-around flex-sm-column text-center bg-white mb-3 mb-sm-0 mx-auto rounded-5 py-sm-4 shadow"
        id="sidebar" style="max-width: 250px">
        @can('all')
          <li class="nav-item my-2">
            <a class="nav-link text-secondary mx-1 mx-sm-3 p-3 px-sm-0 rounded-4 text-uppercase {{ Route::currentRouteName() == 'components.dashboard' ? 'shadow' : '' }}"
              href="{{ route('components.dashboard') }}">
              <i class="bi bi-speedometer d-block fs-5"></i>
              <small class="d-none d-xxl-block">Painel</small>
            </a>
          </li>
        @endcan
        @can('sales')
          <li class="nav-item my-2">
            <a class="nav-link text-secondary mx-1 mx-sm-3 p-3 px-sm-0 rounded-4 text-uppercase {{ Route::currentRouteName() == 'components.sales' ? 'shadow' : '' }}"
              href="{{ route('components.sales') }}">
              <i class="bi bi-cart d-block fs-5"></i>
              <small class="d-none d-xxl-block">Vendas</small>
            </a>
          </li>
        @endcan
        @can('products')
          <li class="nav-item my-2">
            <a class="nav-link text-secondary mx-1 mx-sm-3 p-3 px-sm-0 rounded-4 text-uppercase {{ Route::currentRouteName() == 'components.products' ? 'shadow' : '' }}"
              href="{{ route('components.products') }}">
              <i class="bi bi-bag d-block fs-5"></i>
              <small class="d-none d-xxl-block">Produtos</small>
            </a>
          </li>
        @endcan
        @can('all')
          <li class="nav-item my-2">
            <a class="nav-link text-secondary mx-1 mx-sm-3 p-3 px-sm-0 rounded-4 text-uppercase {{ Route::currentRouteName() == 'components.configurations' ? 'shadow' : '' }}"
              href="{{ route('components.configurations') }}">
              <i class="bi bi-gear d-block fs-5"></i>
              <small class="d-none d-xxl-block">Configurações</small>
            </a>
          </li>
        @endcan
      </ul>
    </div>
    <div class="col-sm-9 col-md-10">
      @yield('content')
    </div>
  </div>

  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  @stack('graphics')
</body>

</html>
