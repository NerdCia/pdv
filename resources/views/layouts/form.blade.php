<!doctype html>
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

  <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="bg-white p-4 rounded-4 shadow-lg"
      style="max-width: 350px;">
      @yield('content')
    </div>
  </div>

  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
