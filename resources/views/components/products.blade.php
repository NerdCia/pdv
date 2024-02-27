@extends('layouts.master')

@section('title', 'Produtos')

@section('content')

  <nav class="my-3 py-2 px-4 bg-white rounded-pill shadow">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="{{ route('components.products') }}"
        class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-body-emphasis text-decoration-none">
        <i class="bi bi-bag d-block fs-2 me-2"></i>
        <span class="fs-4 fw-bold">Produtos</span>
      </a>

      <form class="col-12 col-lg-auto col-xl-6 mb-3 mb-lg-0 me-lg-3" role="search" action="{{ route('components.products') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
          <input type="search" name="search" class="form-control rounded-start-pill shadow" placeholder="Digite o nome ou ID do produto"
            aria-label="Search">
          <button type="submit" class="btn btn-danger rounded-end-pill"><i class="bi bi-search"></i></button>
        </div>
      </form>

      <div class="text-center">
        <button type="button" class="btn btn-danger rounded-pill me-lg-2"><i class="bi bi-plus-lg me-1"></i>Novo
          produto</button>
        <button type="button" class="btn btn-danger rounded-pill"><i class="bi bi-plus-lg me-1"></i>Nova
          categoria</button>
      </div>
    </div>
  </nav>

  <table class="bg-white w-100 shadow-lg align-middle rounded-5 mb-3">
    <thead>
      <tr class="border-bottom">
        <th scope="col"></th>
        <th scope="col"></th>
        <th class="fw-bold py-3" scope="col">Nome</th>
        <th class="fw-bold py-3" scope="col">Quantidade</th>
        <th class="fw-bold py-3" scope="col">Preço</th>
        <th class="fw-bold py-3" scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr class="border-bottom">
          <td class="text-end p-2 fs-5"><input class="form-check-input" type="checkbox" value="{{ $product->id }}"></td>
          <td class="text-center p-2"><img src="{{ $product->image }}" alt="{{ $product->name }}" width="64"></td>
          <td class="p-2">{{ $product->name }}</td>
          <td class="p-2">{{ $product->quantity }}</td>
          <td class="p-2">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
          <td class="p-2"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i class="bi bi-pencil"></i></button></td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $products->links() }}

@endsection
