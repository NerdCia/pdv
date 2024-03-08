@extends('layouts.master')

@section('title', 'Painel')


@section('content')

  <div class="my-3">

    <div class="row row-cols-2">
      <div class="col">
        <div class="card rounded-4 mb-3 shadow border-0">
          <div class="row align-items-center">
            <div class="col">
              <div class="card-body text-center">
                <h3 class="card-title text-body-emphasis">R$ 897,45</h3>
                <p class="card-text"><small class="text-body-tertiary fw-bold">Lucro líquido</small></p>
              </div>
            </div>
            <div class="col m-2">
              <canvas id="profit"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card rounded-4 mb-3 shadow border-0">
          <div class="row align-items-center">
            <div class="col">
              <div class="card-body text-center">
                <h3 class="card-title text-body-emphasis">16</h3>
                <p class="card-text"><small class="text-body-tertiary fw-bold">Quantidade de vendas</small></p>
              </div>
            </div>
            <div class="col m-2">
              <canvas id="salesQuantity"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card rounded-4 mb-3 shadow border-0">
          <div class="row align-items-center">
            <div class="col">
              <div class="card-body text-center">
                <h3 class="card-title text-body-emphasis">R$ 1.897,45</h3>
                <p class="card-text"><small class="text-body-tertiary fw-bold">Faturamento bruto</small></p>
              </div>
            </div>
            <div class="col m-2">
              <canvas id="grossRevenue"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center rounded-4 mb-3 shadow border-0">
          <div class="card-body">
            <p class="card-text"><small class="text-body-secondary fw-bold">Quantidade de produtos cadastrados</small></p>
            <h3 class="card-title text-body-emphasis">{{ count($products) }}</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-8">
        <canvas class="w-100 bg-white rounded-4 my-3 shadow-lg" id="myChart"></canvas>
      </div>
      <div class="col">
        <canvas class="w-100 bg-white rounded-4 my-3 shadow-lg" id="topProducts"></canvas>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg-8">
        <canvas class="w-100 bg-white rounded-4 my-3 shadow-lg" id="NumberSalesPerPaymentMethod"></canvas>
      </div>
      <div class="col">
        <div class="table-responsive bg-white shadow-lg rounded-4 my-3">
          <h5 class="text-center mb-0 mt-2 text-body-emphasis fw-bold">Produtos com menos de 10 em estoque</h5>
          <table class="w-100 align-middle">
            @if (count($productsWithLessThan10InStock) > 0)
              <thead>
                <tr class="border-bottom">
                  <th class="fw-bold py-3 px-3" scope="col">Nome</th>
                  <th class="fw-bold py-3 px-3" scope="col">Quantidade</th>
                  <th class="fw-bold py-3 px-3" scope="col"></th>
                </tr>
              </thead>
            @endif
            <tbody>
              @forelse ($productsWithLessThan10InStock as $key => $product)
                <tr
                  class="{{ $key == count($productsWithLessThan10InStock) - 1 && count($productsWithLessThan10InStock) == 0 ? '' : 'border-bottom' }}">
                  <td class="px-3 py-2">{{ $product->name }}</td>
                  <td class="px-3 py-2 text-center">{{ $product->quantity }}</td>
                  <form action="{{ route('components.product', $product->id) }}" method="GET"
                    enctype="multipart/form-data">
                    <td class="p-2"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                          class="bi bi-pencil"></i></button></td>
                  </form>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-3 fw-bold">Nenhum produto encontrado</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        {{ $productsWithLessThan10InStock->links() }}
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="table-responsive bg-white shadow-lg my-3 rounded-4">
          <h5 class="text-center mb-0 my-3 text-body-emphasis fw-bold">Últimas vendas</h5>
          <table class="w-100 align-middle">
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
              @foreach ($lastSales as $key => $sale)
                <tr class="{{ $key == count($lastSales) - 1 ? '' : 'border-bottom' }}">
                  <td class="text-center p-2 fs-5"><input class="form-check-input" type="checkbox"
                      value="{{ $sale->id }}">
                  </td>
                  <td class="p-2">{{ $sale->user->name }}</td>
                  <td class="p-2">{{ $sale->payment_method }}</td>
                  <td class="p-2">{{ date_format($sale->created_at, 'd/m/Y H:i:s') }}</td>
                  <td class="p-2"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i
                        class="bi bi-pencil"></i></button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('graphics')
  <script src="{{ asset('js/chart.js') }}"></script>

  <script>
    const profit = document.getElementById('profit');
    const salesQuantity = document.getElementById('salesQuantity');
    const grossRevenue = document.getElementById('grossRevenue');
    const ctx = document.getElementById('myChart');
    const topProducts = document.getElementById('topProducts');
    const NumberSalesPerPaymentMethod = document.getElementById('NumberSalesPerPaymentMethod');

    new Chart(grossRevenue, {
      type: 'line',
      data: {
        labels: ['jun', 'fev', 'mar', 'abr', 'mai', 'jun'],
        datasets: [{
          label: 'Faturamento',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 2,
          backgroundColor: '#ed3237',
        }]
      },
      options: {
        devicePixelRatio: 4,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              display: false
            },
            display: false,
          },
          x: {
            grid: {
              display: false
            },
            display: false,
          },
        },
        animation: false
      }
    });

    new Chart(salesQuantity, {
      type: 'line',
      data: {
        labels: ['jun', 'fev', 'mar', 'abr', 'mai', 'jun'],
        datasets: [{
          label: 'Vendas',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 2,
          backgroundColor: '#ed3237',
        }]
      },
      options: {
        devicePixelRatio: 4,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              display: false
            },
            display: false,
          },
          x: {
            grid: {
              display: false
            },
            display: false,
          },
        },
        animation: false
      }
    });

    new Chart(profit, {
      type: 'line',
      data: {
        labels: ['jun', 'fev', 'mar', 'abr', 'mai', 'jun'],
        datasets: [{
          label: 'Lucro',
          data: [12, 19, 8, 10, 11, 20],
          borderWidth: 2,
          backgroundColor: '#ed3237',
        }]
      },
      options: {
        devicePixelRatio: 4,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              display: false
            },
            display: false,
          },
          x: {
            grid: {
              display: false
            },
            display: false,
          },
        },
        animation: false
      }
    });

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Luis', 'Henrique', 'Ricardo', 'Maria', 'Kamily', 'João'],
        datasets: [{
          label: 'Quantidade de vendas por funcionário',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 2,
          backgroundColor: '#ed3237',
        }]
      },
      options: {
        devicePixelRatio: 4,
        scales: {
          y: {
            beginAtZero: true
          }
        },
        layout: {
          padding: 20
        },
        animation: false
      }
    });

    new Chart(topProducts, {
      type: 'doughnut',
      data: {
        labels: ['Banana nanica', 'Uva passa', 'Desodorante', 'Creme de cabelo', 'Pão Fracês', 'Laranja'],
        datasets: [{
          label: 'Produtos mais vendidos',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 2,
          backgroundColor: '#ed3237',
        }]
      },
      options: {
        devicePixelRatio: 4,
        scales: {
          y: {
            beginAtZero: true
          }
        },
        layout: {
          padding: 20
        },
        animation: false
      }
    });

    new Chart(NumberSalesPerPaymentMethod, {
      type: 'bar',
      data: {
        labels: ['Cartão de crédito', 'Pix', 'Cartão de débito', 'Dinheiro', 'Boleto bancário'],
        datasets: [{
          label: 'Quantidade de vendas por forma de pagamento',
          data: [12, 19, 3, 5, 2],
          borderWidth: 2,
          backgroundColor: '#ed3237',
        }]
      },
      options: {
        devicePixelRatio: 4,
        indexAxis: 'y',
        scales: {
          y: {
            beginAtZero: true
          }
        },
        layout: {
          padding: 20
        },
        animation: false
      }
    });
  </script>
@endpush
