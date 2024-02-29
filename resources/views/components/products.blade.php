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

      <form class="col-12 col-lg-auto col-xl-6 mb-3 mb-lg-0 me-lg-3" role="search"
        action="{{ route('components.products') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
          <div class="dropdown">
            <button class="btn btn-danger dropdown-toggle rounded-start-pill" type="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Categorias
            </button>
            <ul class="dropdown-menu shadow border-0">
              @foreach ($categories as $category)
                <li><a class="dropdown-item" href="">{{ $category->name }}</a></li>
              @endforeach
            </ul>
          </div>
          <input type="search" name="searchProducts" class="form-control shadow"
            placeholder="Digite o nome ou ID do produto" aria-label="Search">
          <button type="submit" class="btn btn-danger rounded-end-pill"><i class="bi bi-search"></i></button>
        </div>
      </form>

      <div class="text-center">
        <button type="button" class="btn btn-danger rounded-pill me-lg-2" data-bs-toggle="modal"
          data-bs-target="#addProductModal"><i class="bi bi-plus-lg me-1"></i>Novo
          produto</button>
        <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
          data-bs-target="#addCategoryModal"><i class="bi bi-plus-lg me-1"></i>Nova
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
      @forelse ($products as $key => $product)
        <tr class="{{ $key == count($products) - 1 && count($products) == 0 ? '' : 'border-bottom' }}">
          <td class="text-end p-2 fs-5"><input class="form-check-input" type="checkbox" value="{{ $product->id }}"></td>
          <td class="text-center p-2"><img src="{{ $product->image }}" alt="{{ $product->name }}" width="64"></td>
          <td class="p-2">{{ $product->name }}</td>
          <td class="p-2">{{ $product->quantity }}</td>
          <td class="p-2">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
          <td class="p-2"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                class="bi bi-pencil"></i></button></td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center py-3 fw-bold">Nenhum produto encontrado</td></tr>
      @endforelse
    </tbody>
  </table>

  <x-add_category :list="$categories" />

  <x-add_product />

  {{ $products->links() }}

@endsection
