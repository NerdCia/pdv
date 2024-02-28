@extends('components.sales')
@section('title', 'Nova venda')
@section('modal')
  <div class="modal fade show" id="addSaleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="saleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content rounded-4 border-0">
        <div class="modal-header">
          <h1 class="modal-title fs-4 fw-bold text-body-emphasis" id="saleModalLabel"><i
              class="bi bi-cart fs-2 me-2"></i>Criar nova venda</h1>
          <a href="{{ route('components.sales') }}" class="btn-close"></a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-8">
              <nav class="col-12 mb-3 mb-lg-0 me-lg-3">
                <div class="dropdown">
                  <div class="input-group">
                    <form class="input-group" role="search" action="{{ route('components.add_sale') }}" method="GET"
                      enctype="multipart/form-data">
                      @csrf
                      <input type="search" name="searchProducts" class="form-control shadow rounded-start-pill"
                        placeholder="Digite o nome ou ID do produto" aria-label="Search" data-bs-toggle="dropdown"
                        aria-expanded="false">
                      <button type="submit" class="btn btn-danger rounded-end-pill"><i class="bi bi-search"></i></button>
                    </form>
                    <div class="border-0 rounded-4 dropdown-menu dropdown-menu-end px-4 shadow">
                      <table class="bg-white w-100 align-middle mb-3">
                        <tbody>
                          @foreach ($products as $key => $product)
                            <tr class="{{ $key == count($products) - 1 ? '' : ' border-bottom' }}">
                              <td class="text-center p-2"><img src="{{ $product->image }}" alt="{{ $product->name }}"
                                  width="32"></td>
                              <td class="p-2"><small>{{ $product->name }}</small></td>
                              <td class="p-2"><small>R$ {{ number_format($product->price, 2, ',', '.') }}</small>
                              </td>
                              <td class="text-end p-2"><button
                                  class="btn btn-danger btn-sm rounded-circle align-middle"><i
                                    class="bi bi-plus-lg"></i></button></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $products->links() }}
                    </div>
                  </div>
                </div>
              </nav>
            </div>
            <div class="col">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
