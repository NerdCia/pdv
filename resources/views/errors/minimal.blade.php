<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
  <div class="container">
    <div class="bg-white shadow-lg rounded-5 p-4 position-absolute top-50 start-50 translate-middle">
      <div class="text-center mb-3">
        @if (isset($logo) && Storage::get($logo))
          <img src="{{ url("storage/{$logo}") }}" class="img-fluid rounded-circle w-25 shadow" alt="Logo">
        @else
          <img src="{{ asset('img/logo.png') }}" class="img-fluid rounded-circle w-25 shadow" alt="Logo">
        @endif
        <h3 class="mt-2 text-body-emphasis fw-bold">Erro @yield('code')</h3>
      </div>
      <h4 class="fw-bold text-body-emphasis text-center">
        @yield('message')
      </h4>
    </div>
  </div>
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
</body>

</html>
