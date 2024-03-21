@extends('layouts.form')

@section('title', 'Conecte-se')

@section('content')
  <form action="{{ route('form.auth') }}" method="POST" novalidate>
    @csrf
    <div class="text-center">
      @if (isset($logo) && Storage::get($logo))
        <img src="{{ url("storage/{$logo}") }}" class="img-fluid rounded-circle w-25 shadow" alt="Logo">
      @else
        <img src="{{ asset('img/logo.png') }}" class="img-fluid rounded-circle w-25 shadow" alt="Logo">
      @endif
      <h3 class="mt-2 text-body-emphasis fw-bold">Conecte-se</h3>
    </div>
    <div class="col mb-3">
      <label for="inputEmail" class="form-label"><small class="fw-bold text-body-emphasis">Email:</small></label>
      <input type="email" class="form-control shadow {{ count($errors->get('email')) > 0 ? 'is-invalid' : '' }}"
        name="email" id="inputEmail" aria-describedby="validationServerEmailFeedback" placeholder="Digite seu email"
        required>
      @if ($errors->has('email'))
        @foreach ($errors->get('email') as $message)
          @include('includes.invalid-feedback', [
              'id' => 'validationServerEmailFeedback',
              'message' => $message,
          ])
        @endforeach
      @endif
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label"><small class="fw-bold text-body-emphasis">Senha:</small></label>
      <input type="password" class="form-control shadow {{ count($errors->get('password')) > 0 ? 'is-invalid' : '' }}"
        name="password" id="inputPassword" aria-describedby="validationServerPasswordFeedback" placeholder="Digite sua senha" required>
      @if ($errors->has('password'))
        @foreach ($errors->get('password') as $message)
          @include('includes.invalid-feedback', [
              'id' => 'validationServerPasswordFeedback',
              'message' => $message,
          ])
        @endforeach
      @endif
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
