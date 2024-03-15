@extends('layouts.master')

@section('title', 'Vendas')

@section('content')

  <nav class="mb-3 py-2 px-4 bg-white rounded-pill shadow">
    <div class="d-flex align-items-center flex-wrap justify-content-lg-start">
      <a href="{{ route('components.sales') }}" class="me-auto text-body-emphasis text-decoration-none">
        <i class="bi bi-cart fs-2 me-2"></i>
        <span class="fs-4 fw-bold d-none d-sm-inline-block">Vendas</span>
      </a>
      <div class="text-center">
        <a href="{{ route('components.create_sale') }}" class="btn btn-danger rounded-pill"><i
            class="bi bi-plus-lg me-1"></i>Nova
          Venda</a>
      </div>
    </div>
  </nav>

  <div class="table-responsive shadow-lg mb-3 rounded-5">
    <table class="bg-white w-100 align-middle">
      <thead>
        <tr class="border-bottom">
          <th scope="col"></th>
          <th class="fw-bold py-3 px-2" scope="col">Usuário</th>
          <th class="fw-bold py-3 px-2" scope="col">Método de pagamento</th>
          <th class="fw-bold py-3 px-2" scope="col">Data</th>
          <th class="fw-bold py-3 px-2" scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sales as $key => $sale)
          <tr class="{{ $key == count($sales) - 1 ? '' : 'border-bottom' }}">
            <td class="text-center p-2 fs-5"><input class="form-check-input" type="checkbox" value="{{ $sale->id }}">
            </td>
            <td class="p-2">{{ $sale->user->name }}</td>
            <td class="p-2">{{ $sale->payment_method }}</td>
            <td class="p-2">{{ date_format($sale->created_at, 'd/m/Y H:i:s') }}</td>
            <form action="{{ route('components.edit_sale', $sale->id) }}" method="GET" enctype="multipart/form-data">
              <td class="py-2"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                    class="bi bi-eye"></i></button></td>
            </form>
            <form action="{{ route('sale.destroy', $sale->id) }}" method="POST" enctype="multipart/form-data">
              @method('DELETE')
              @csrf
              <td class="py-2"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                    class="bi bi-x-lg"></i></button></td>
            </form>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @yield('modal')

  {{ $sales->links() }}

@endsection
