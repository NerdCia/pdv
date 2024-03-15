@extends('components.sales')

@section('title', 'Editar venda')

@section('modal')

  <div class="modal fade" id="editSaleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="saleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
      <div class="modal-content rounded-4 border-0">
        <div class="modal-header">
          <h1 class="modal-title fs-4 fw-bold text-body-emphasis" id="saleModalLabel"><i
              class="bi bi-bag fs-2 me-2"></i>Editar venda</h1>
          <a type="button" class="btn-close" href="{{ route('components.sales') }}"></a>
        </div>
        <div class="modal-body">
          <div class="col-lg-6 shadow mx-auto my-3 p-4 rounded-4">
            <div class="order-md-last">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-danger fw-bold">Produtos</span>
                <span class="badge bg-danger rounded-pill">{{ count($saleProducts) }}</span>
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
                    @if (count($saleProducts) > 0)
                      R$ {{ number_format($totalPaid, 2, ',', '.') }}
                    @else
                      R$ 0,00
                    @endif
                  </strong>
                </li>
                <li class="list-group-item align-items-center d-flex justify-content-between">
                  <strong>Método de pagamento</strong>
                  <strong class="fs-5">{{ $sale->payment_method }}</strong>
                </li>
                <li class="list-group-item align-items-center d-flex justify-content-between">
                  <strong>Vendido por</strong>
                  <strong>{{ $user->name }}</strong>
                </li>
              </ul>
            </div>
          </div>
          <div class="table-responsive shadow-lg mb-3 rounded-4">
            <table class="bg-white w-100 align-middle text-center">
              <thead>
                <tr class="border-bottom">
                  <th scope="col"></th>
                  <th class="fw-bold py-3 px-2" scope="col">Nome do produto</th>
                  <th class="fw-bold py-3 px-2" scope="col">Preço do produto</th>
                  <th class="fw-bold py-3 px-2" scope="col">Quantidade</th>
                  <th class="fw-bold py-3 px-2" scope="col">Total pago</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($saleProducts as $key => $product)
                  <tr class="{{ $key == count($saleProducts) - 1 ? '' : 'border-bottom' }}">
                    @if ($product->id_product)
                      <td class="p-2 text-center d-none d-lg-table-cell"><img
                          src="{{ url("storage/{$product->products->image}") }}" width="64"
                          alt="{{ $product->products->name }}"></td>
                    @else
                      <td class="p-2 text-danger text-center fw-bold">O produto foi removido!</td>
                    @endif
                    <td class="p-2">{{ $product->name_product }}</td>
                    <td class="p-2">R$ {{ number_format($product->price_product, 2, ',', '.') }}</td>
                    <td class="p-2">{{ abs($product->quantity) }}</td>
                    <td class="p-2">R$ {{ number_format($product->amount, 2, ',', '.') }}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr class="border-top">
                  <td colspan="3"></td>
                  <td class="p-4 fw-bold fs-5">{{ $totalAmount }}</td>
                  <td class="p-4 fw-bold fs-5">R$ {{ number_format($totalPaid, 2, ',', '.') }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
