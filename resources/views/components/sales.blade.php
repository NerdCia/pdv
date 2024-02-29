@extends('layouts.master')

@section('title', 'Vendas')

@section('content')

  <nav class="my-3 py-2 px-4 bg-white rounded-pill shadow">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="{{ route('components.sales') }}"
        class="d-flex align-items-center me-auto text-body-emphasis text-decoration-none">
        <i class="bi bi-cart d-block fs-2 me-2"></i>
        <span class="fs-4 fw-bold">Vendas</span>
      </a>
      <div class="text-center">
        <a href="{{ route('components.create_sale') }}" class="btn btn-danger rounded-pill me-lg-2"><i class="bi bi-plus-lg me-1"></i>Nova
          Venda</a>
      </div>
    </div>
  </nav>

  <table class="bg-white w-100 shadow-lg align-middle rounded-5 mb-3">
    <thead>
      <tr class="border-bottom">
        <th scope="col"></th>
        <th class="fw-bold py-3" scope="col">Usuário</th>
        <th class="fw-bold py-3" scope="col">Data</th>
        <th class="fw-bold py-3" scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sales as $key => $sale)
        <tr class="{{ $key == count($sales) - 1 ? '' : 'border-bottom' }}">
          <td class="text-center py-2 fs-5"><input class="form-check-input" type="checkbox" value="{{ $sale->id }}">
          </td>
          <td class="py-2">{{ $sale->user->name }}</td>
          <td class="py-2">{{ $sale->created_at }}</td>
          <td><button class="btn btn-danger btn-sm rounded-circle align-middle"><i class="bi bi-pencil"></i></button></td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @yield('modal')

  {{ $sales->links() }}

@endsection
