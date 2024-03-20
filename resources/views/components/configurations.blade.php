@extends('layouts.master')

@section('title', 'Configurações')

@section('content')

  <nav class="mb-3 py-2 px-4 bg-white rounded-pill shadow">
    <div class="d-flex align-items-center flex-wrap justify-content-lg-start">
      <a href="{{ route('components.sales') }}" class="me-auto text-body-emphasis text-decoration-none">
        <i class="bi bi-gear fs-2 me-2 align-middle"></i>
        <span class="fs-4 fw-bold d-none d-md-inline-block align-middle">Configurações</span>
      </a>
    </div>
  </nav>
  <div class="bg-white shadow-lg rounded-5 p-4 mb-3">
    <div class="row row-cols-1 row-cols-md-2 mb-3">
      <div class="col">
        <div class="shadow rounded-4 p-4">
          <form action="{{ route('configurations.update') }}" method="post" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <h5 class="fs-5 fw-bold text-body-emphasis border-bottom pb-2 text-center">Informações da empresa</h5>
            <div class="mb-3">
              <div class="row">
                <div class="col-md-4">
                  @if (isset($logo) && Storage::get($logo))
                    <img src="{{ url("storage/{$logo}") }}" class="img-fluid shadow my-2 rounded-4" alt="Logo">
                  @else
                  <img src="{{ asset('img/logo.png') }}" class="img-fluid shadow my-2 rounded-4" alt="Logo">
                  @endif
                </div>
                <div class="col align-self-center">
                  <label for="imageFile" class="form-label"><small class="fw-bold text-body-emphasis">Selecione a
                      logo:</small></label>
                  <input class="form-control form-control-sm shadow" type="file" name="image" id="imageFile">
                </div>
              </div>
            </div>
            {{-- <div class="mb-3">
              <label for="colorInput" class="form-label"><small class="fw-bold text-body-emphasis">Paleta de cores do
                  site:</small></label>
              <div class="input-group">
                <input type="color" class="form-control form-control-color" id="colorInput" value="#ed3237"
                  title="Choose your color">
                <input type="color" class="form-control form-control-color" id="colorInput" value="#ffffff"
                  title="Choose your color">
              </div>
            </div> --}}
            <div class="mb-3">
              <label for="companyInputName" class="form-label"><small class="fw-bold text-body-emphasis">Nome da
                  empresa:</small></label>
              <input type="text" class="form-control shadow" name="company_name" id="companyInputName"
                placeholder="Digite o nome da empresa" value="{{ $company_name }}">
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-danger rounded-pill" type="submit">Salvar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col">
        <div class="shadow rounded-4 p-4">
          <form action="{{ route('user.update', Auth::id()) }}" method="post" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <h5 class="fs-5 fw-bold text-body-emphasis border-bottom pb-2 text-center">Informações do usuário</h5>
            {{-- <div class="mb-3">
              <div class="row">
                <div class="col-md-4">
                  <img src="{{ asset('img/logo.png') }}" class="img-fluid shadow my-2 rounded-4" alt="Logo">
                </div>
                <div class="col align-self-center">
                  <label for="imageFile" class="form-label"><small class="fw-bold text-body-emphasis">Selecione a foto de
                      perfil:</small></label>
                  <input class="form-control form-control-sm shadow" type="file" name="image" id="imageFile">
                </div>
              </div>
            </div> --}}
            <div class="mb-3">
              <label for="userInputName" class="form-label"><small class="fw-bold text-body-emphasis">Nome do
                  usuário:</small></label>
              <input type="text" class="form-control shadow" name="name" id="userInputName"
                placeholder="Digite o nome de usuário" value="{{ Auth::user()->name }}">
            </div>
            <div class="mb-3">
              <label for="userInputPassword" class="form-label"><small class="fw-bold text-body-emphasis">Redefinir
                  senha:</small></label>
              <input type="password" class="form-control shadow" name="password" id="userInputPassword"
                placeholder="Digite uma senha">
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-danger rounded-pill" type="submit">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="table-responsive-lg shadow-lg mb-3 rounded-4">
      <table class="bg-white w-100 align-middle">
        <thead>
          <tr class="border-bottom">
            <th class="fw-bold p-3" scope="col">Usuário</th>
            <th class="fw-bold p-3" scope="col">Email</th>
            <th class="fw-bold p-3" scope="col">Permissões</th>
            <th class="fw-bold p-3" scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $key => $user)
            <form action="{{ route('user.role.update', $user->id) }}" method="POST" enctype="multipart/form-data">
              @method('POST')
              @csrf
              <tr class="{{ $key == count($users) - 1 ? '' : 'border-bottom' }}">
                <td class="py-2 px-3">{{ $user->name }}</td>
                <td class="py-2 px-3">{{ $user->email }}</td>
                <td class="py-2 px-3">
                  <div class="dropdown">
                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      Permissões
                    </button>
                    <ul class="dropdown-menu border-0 shadow mt-2">
                      @foreach ($roles as $role)
                        <li class="px-2 py-1">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="{{ $role->id }}"
                              name="{{ $role->name }}" value="{{ $role->id }}"
                              {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                            <label class="form-check-label text-capitalize"
                              for="flexSwitchCheckRole">{{ $role->name }}</label>
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </td>
                <td class="py-2 px-3 col-2 text-center">
                  <button type="submit" class="btn btn-danger btn-sm rounded-pill"><i
                      class="bi bi-arrow-clockwise"></i></button>
                </td>
              </tr>
            </form>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
