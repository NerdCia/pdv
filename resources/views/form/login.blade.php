@extends('layouts.form')

@section('title', 'Conecte-se')

@section('content')

  @if ($message = Session::get('error'))
    {{ $message }}
  @endif

  @if ($errors)
    @foreach ($errors->all() as $error)
      {{ $error }}
    @endforeach
  @endif
  <form action="{{ route('form.auth') }}" method="POST">
    @csrf
    <div class="text-center">
      <img src="{{ asset('img/logo.png') }}" class="img-fluid rounded-circle w-25 shadow" alt="Logo">
      <h3 class="mt-2 text-body-emphasis fw-bold">Conecte-se</h3>
    </div>
    <div class="mb-3">
      <label for="inputEmail" class="form-label"><small class="fw-bold text-body-emphasis">Email:</small></label>
      <input type="email" class="form-control shadow" name="email" id="inputEmail" aria-describedby="emailHelp"
        placeholder="Digite seu email">
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label"><small class="fw-bold text-body-emphasis">Senha:</small></label>
      <input type="password" class="form-control shadow" name="password" id="inputPassword"
        placeholder="Digite sua senha">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" name="remember" id="check">
      <label class="form-check-label" for="check">Lembrar-me</label>
    </div>
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-danger rounded-pill">Conectar</button>
    </div>
    <div class="text-center mt-2">
      <small>Não possui uma conta? <a href="{{ route('form.register') }}">Cadastre-se</a></small>
    </div>
  </form>

@endsection
