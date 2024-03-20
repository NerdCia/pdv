@extends('components.sales')

@section('title', 'Nova venda')

@section('modal')
  <div class="modal fade show" id="addSaleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="saleModalLabel" aria-hidden="true">

    @if ($message = Session::get('success'))
      <div
        class="alert bg-white shadow alert-dismissible fade show position-absolute top-0 end-0 mt-4 me-4 z-3 col-4 d-flex align-items-center col-10 col-md-auto"
        role="alert">
        <i class="bi bi-check-circle me-2 fs-4 text-success"></i>
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if ($message = Session::get('warning'))
      <div
        class="alert bg-white shadow alert-dismissible fade show position-absolute top-0 end-0 mt-4 me-4 z-3 col-4 d-flex align-items-center col-10 col-md-auto"
        role="alert">
        <i class="bi bi-check-circle me-2 fs-4 text-warning"></i>
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="modal-dialog modal-xl">
      <div class="modal-content rounded-4 border-0">
        <div class="modal-header">
          <h1 class="modal-title fs-4 fw-bold text-body-emphasis" id="saleModalLabel"><i
              class="bi bi-cart fs-2 me-2"></i>Criar nova venda</h1>
          <a href="{{ route('components.sales') }}" class="btn-close"></a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-8">
              <nav class="col-12 mb-3 mb-lg-0 me-lg-3">
                <div class="dropdown">
                  <div class="input-group">
                    <form class="input-group" role="search" action="{{ route('components.create_sale') }}" method="GET"
                      enctype="multipart/form-data">
                      @csrf
                      <input type="search" name="searchProducts" class="form-control shadow rounded-start-pill"
                        placeholder="Digite o nome ou ID do produto" aria-label="Search" data-bs-toggle="collapse"
                        data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                      <button type="submit" class="btn btn-danger rounded-end-pill"><i class="bi bi-search"></i></button>
                    </form>
                    <div class="border-0 bg-white rounded-4 collapse px-4 mt-2 shadow position-absolute end-0 top-100 z-3"
                      id="collapseProducts">
                      <table class="bg-white w-100 align-middle my-2">
                        <tbody>
                          @forelse ($products as $key => $product)
                            <form action="{{ route('sale.product.add') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <tr class="{{ $key == count($products) - 1 ? '' : ' border-bottom' }}">
                                <td class="text-center p-2"><img src="{{ url("storage/{$product->image}") }}"
                                    alt="{{ $product->name }}" width="32"></td>
                                <td class="p-2"><small>{{ $product->name }}</small></td>
                                <td class="p-2"><small>R$ {{ number_format($product->price, 2, ',', '.') }}</small>
                                </td>
                                <td class="text-end p-2">
                                  <input type="hidden" name="id" value="{{ $product->id }}">
                                  <input type="hidden" name="name" value="{{ $product->name }}">
                                  <input type="hidden" name="price" value="{{ $product->price }}">
                                  <input type="hidden" name="expense" value="{{ $product->expense }}">
                                  <input type="hidden" name="quantity" value="1">
                                  <input type="hidden" name="image" value="{{ $product->image }}">
                                  <button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                                      class="bi bi-plus-lg"></i></button>
                                </td>
                              </tr>
                            </form>
                          @empty
                            <tr>
                              <td class="text-center p-2 fw-bold">Nenhum produto encontrado</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                      {{ $products->links() }}
                    </div>
                  </div>
                </div>
              </nav>
              <div class="table-responsive shadow rounded-4 my-3">
                <table class="bg-white w-100 align-middle">
                  @if (count($items) != 0)
                    <thead>
                      <tr class="border-bottom">
                        <th class="d-none d-lg-table-cell" scope="col"></th>
                        <th class="fw-bold py-3 px-2" scope="col">Nome</th>
                        <th class="fw-bold py-3 px-2" scope="col">Preço</th>
                        <th class="fw-bold py-3 px-2" scope="col">Quantidade</th>
                        <th class="fw-bold py-3 px-2" scope="col"></th>
                        <th class="fw-bold py-3 px-2" scope="col"></th>
                        <th class="fw-bold py-3 px-2" scope="col"></th>
                      </tr>
                    </thead>
                  @else
                    <tr>
                      <td colspan="7" class="text-center py-3 fw-bold">Nenhum produto adicionado</td>
                    </tr>
                  @endif
                  <tbody>
                    @foreach ($items as $key => $item)
                      <tr class="{{ $key == count($items) - 1 && count($items) == 0 ? '' : 'border-bottom' }}">
                        <td class="text-center p-2 d-none d-lg-table-cell"><img
                            src="{{ url("storage/{$item->attributes->image}") }}" alt="{{ $item->name }}"
                            width="32"></td>
                        <td class="p-2">{{ $item->name }}</td>
                        <td class="p-2">R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                        <form action="{{ route('sale.product.update') }}" method="POST"
                          enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="id" value="{{ $item->id }}">
                          <td class="p-2"><input class="form-control form-control-sm" type="number"
                              name="quantity" value="{{ $item->quantity }}" min="1"
                              max="{{ $products->where('id', 'like', $item->id)->value('quantity') }}"></td>
                          <td class="text-center p-2">
                            <button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                                class="bi bi-arrow-clockwise"></i></button>
                          </td>
                        </form>
                        <form action="{{ route('sale.product.remove') }}" method="POST"
                          enctype="multipart/form-data">
                          @csrf
                          <td class="text-center p-2">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                                class="bi bi-x-lg"></i></button>
                          </td>
                        </form>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col shadow mx-2 p-4 rounded-4">
              <div class="order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-danger fw-bold">Produtos</span>
                  <span class="badge bg-danger rounded-pill">{{ count($items) }}</span>
                </h4>
                <ul class="list-group mb-3 border-0">
                  @isset($discount)
                    <li class="list-group-item align-items-center d-flex justify-content-between bg-body-tertiary">
                      <div class="text-success">
                        <h6 class="my-0">Descontos</h6>
                      </div>
                      <span class="text-success">−$5</span>
                    </li>
                  @endisset
                  @isset($promoCode)
                    <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                      <div class="text-success">
                        <h6 class="my-0">Código promocional</h6>
                        <small>NERDCIAOFERTAS</small>
                      </div>
                      <span class="text-success">−$5</span>
                    </li>
                  @endisset
                  <li class="list-group-item align-items-center d-flex justify-content-between">
                    <strong class="fs-4">Total</strong>
                    <strong class="fs-5">
                      @if (count($items) > 0)
                        R$ {{ number_format($total, 2, ',', '.') }}
                      @else
                        R$ 0,00
                      @endif
                    </strong>
                  </li>
                </ul>
                <form class="p-2">
                  <div class="input-group">
                    <input type="text" class="form-control rounded-start-pill" placeholder="Código promocional">
                    <button type="submit" class="btn btn-danger rounded-end-pill">Resgatar</button>
                  </div>
                </form>
              </div>
              <form class="mt-3 text-center" action="{{ route('sale.store') }}" method="POST"
                enctype="multipart/form-data">
                @method('POST')
                @csrf
                <input type="text" class="form-control rounded-pill my-2" name="payment_method"
                  placeholder="Método de pagamento">
                <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                <button type="submit" class="btn btn-danger btn-lg rounded-pill">Finalizar compra</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
