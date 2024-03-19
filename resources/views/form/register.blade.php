@extends('layouts.form')

@section('title', 'Cadastre-se')

@section('content')

  @if ($message = Session::get('error'))
    {{ $message }}
  @endif

  @if ($errors)
    @foreach ($errors->all() as $error)
      {{ $error }}
    @endforeach
  @endif
  <form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="text-center">
      @if (isset($logo) && Storage::get($logo))
        <img src="{{ url("storage/{$logo}") }}" class="img-fluid rounded-circle w-25 shadow" alt="Logo">
      @else
        <img src="{{ asset('img/logo.png') }}" class="img-fluid rounded-circle w-25 shadow" alt="Logo">
      @endif
      <h3 class="mt-2 text-body-emphasis fw-bold">Cadastre-se</h3>
    </div>
    <div class="mb-3">
      <label for="inputName" class="form-label"><small class="fw-bold text-body-emphasis">Nome:</small></label>
      <input type="text" class="form-control shadow" name="name" id="inputName" aria-describedby="emailHelp" placeholder="Digite seu nome">
    </div>
    <div class="mb-3">
      <label for="inputEmail" class="form-label"><small class="fw-bold text-body-emphasis">Email:</small></label>
      <input type="email" class="form-control shadow" name="email" id="inputEmail" aria-describedby="emailHelp" placeholder="Digite seu email">
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label"><small class="fw-bold text-body-emphasis">Senha:</small></label>
      <input type="password" class="form-control shadow" name="password" id="inputPassword" placeholder="Digite sua senha">
    </div>
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-danger rounded-pill">Cadastrar</button>
    </div>
    <div class="text-center mt-2">
      <small>Já tem uma conta? <a href="{{ route('form.login') }}">Conecte-se</a></small>
    </div>
  </form>

@endsection
