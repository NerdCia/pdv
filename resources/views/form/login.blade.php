@extends('layouts.form')

@section('title', 'Login')

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
      <img src="/img/logo.png" class="img-fluid rounded-circle w-25 shadow" alt="Logo">
      <h3 class="mt-2 text-body-emphasis fw-bold">Nerd<span style="color: #ed3237">&amp;</span>Cia</h3>
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
      <button type="submit" class="btn btn-danger rounded-pill">Login</button>
    </div>
  </form>

@endsection
