@extends('layouts.form')

@section('title', 'Cadastre-se')

@section('content')

  @if ($message = Session::get('error'))
    {{ $message }}
  @endif
  <form action="{{ route('users.store') }}" method="POST" novalidate>
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
      <input type="text" class="form-control shadow {{ count($errors->get('name')) > 0 ? 'is-invalid' : '' }}"
        name="name" id="inputName" aria-describedby="validationServerNameFeedback" placeholder="Digite seu nome"
        required>
      @if ($errors->has('name'))
        @foreach ($errors->get('name') as $message)
          @include('includes.invalid-feedback', [
              'id' => 'validationServerNameFeedback',
              'message' => $message,
          ])
        @endforeach
      @endif
    </div>
    <div class="mb-3">
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
        name="password" id="inputPassword" aria-describedby="validationServerPasswordFeedback"
        placeholder="Digite sua senha" required>
      @if ($errors->has('password'))
        @foreach ($errors->get('password') as $message)
          @include('includes.invalid-feedback', [
              'id' => 'validationServerPasswordFeedback',
              'message' => $message,
          ])
        @endforeach
      @endif
    </div>
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-danger rounded-pill">Cadastrar</button>
    </div>
    <div class="text-center mt-2">
      <small>Já tem uma conta? <a href="{{ route('form.login') }}">Conecte-se</a></small>
    </div>
  </form>

@endsection
