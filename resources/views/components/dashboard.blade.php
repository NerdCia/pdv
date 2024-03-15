@extends('layouts.master')

@section('title', 'Painel')


@section('content')

  <div class="row row-cols-1 row-cols-lg-2">
    <div class="col">
      <div class="card rounded-4 mb-3 shadow border-0">
        <div class="row row-cols-1 row-cols-lg-2 align-items-center">
          <div class="col">
            <div class="card-body text-center">
              <h3 class="card-title text-body-emphasis">R$ {{ number_format($profitsTotal, 2, ',', '.') }}</h3>
              <p class="card-text"><small class="text-body-tertiary fw-bold">Lucro líquido</small></p>
            </div>
          </div>
          <div class="col m-auto">
            <canvas id="profit"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card rounded-4 mb-3 shadow border-0">
        <div class="row row-cols-1 row-cols-lg-2 align-items-center">
          <div class="col">
            <div class="card-body text-center">
              <h3 class="card-title text-body-emphasis">{{ $salesQuantityTotal }}</h3>
              <p class="card-text"><small class="text-body-tertiary fw-bold">Quantidade de vendas</small></p>
            </div>
          </div>
          <div class="col m-auto">
            <canvas id="salesQuantity"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card rounded-4 mb-3 shadow border-0">
        <div class="row row-cols-1 row-cols-lg-2 align-items-center">
          <div class="col">
            <div class="card-body text-center">
              <h3 class="card-title text-body-emphasis">R$ {{ number_format($grossRevenueTotal, 2, ',', '.') }}</h3>
              <p class="card-text"><small class="text-body-tertiary fw-bold">Faturamento bruto</small></p>
            </div>
          </div>
          <div class="col m-auto">
            <canvas id="grossRevenue"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card rounded-4 mb-3 shadow border-0">
        <div class="row row-cols-1 row-cols-lg-2 align-items-center">
          <div class="col">
            <div class="card-body text-center">
              <h3 class="card-title text-body-emphasis">{{ number_format($profitMarginEverage, 2) }}%</h3>
              <p class="card-text"><small class="text-body-tertiary fw-bold">Margem de lucro</small></p>
            </div>
          </div>
          <div class="col m-auto">
            <canvas id="profitMargin"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="bg-white rounded-4 shadow-lg mb-3" style="height: 60vh; max-height: 400px;">
        <canvas id="numberSalesPerEmployee"></canvas>
      </div>
    </div>
    <div class="col">
      <div class="bg-white rounded-4 shadow-lg mb-3" style="height: 60vh; max-height: 400px;">
        <canvas id="topSellingProducts"></canvas>
      </div>
    </div>
    <div class="col">
      <div class="bg-white rounded-4 shadow-lg mb-3" style="height: 60vh; max-height: 400px;">
        <canvas id="NumberSalesPerPaymentMethod"></canvas>
      </div>
    </div>
    <div class="col">
      <div class="table-responsive bg-white shadow-lg rounded-4 mb-3">
        <p class="text-center mb-0 mt-2"><small class="text-body-tertiary fw-bold">Produtos com menos de 10 em
            estoque</small></p>
        <table class="w-100 align-middle">
          @if (count($productsWithLessThan10InStock) > 0)
            <thead>
              <tr class="border-bottom">
                <th class="fw-bold py-3 px-4" scope="col">Nome</th>
                <th class="fw-bold py-3 px-4" scope="col">Quantidade</th>
                <th class="fw-bold py-3 px-4" scope="col"></th>
              </tr>
            </thead>
          @endif
          <tbody>
            @forelse ($productsWithLessThan10InStock as $key => $product)
              <tr
                class="{{ $key == count($productsWithLessThan10InStock) - 1 && count($productsWithLessThan10InStock) == 0 ? '' : 'border-bottom' }}">
                <td class="py-2 px-4">{{ $product->name }}</td>
                <td class="py-2 px-4 text-center">{{ $product->quantity }}</td>
                <form action="{{ route('components.edit_product', $product->id) }}" method="GET"
                  enctype="multipart/form-data">
                  <td class="py-2 px-4"><button class="btn btn-danger btn-sm rounded-circle align-middle"><i
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
    <div class="col w-100">
      <div class="table-responsive bg-white shadow-lg mb-3 rounded-4">
        <p class="text-center mb-0 my-3"><small class="text-body-tertiary fw-bold">Últimas vendas</small></p>
        <table class="w-100 align-middle">
          <thead>
            <tr class="border-bottom">
              <th class="fw-bold py-3 px-4" scope="col">Usuário</th>
              <th class="fw-bold py-3 px-4" scope="col">Método de pagamento</th>
              <th class="fw-bold py-3 px-4" scope="col">Data</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($lastSales as $key => $sale)
              <tr class="{{ $key == count($lastSales) - 1 ? '' : 'border-bottom' }}">
                <td class="py-2 px-4">{{ $sale->user->name }}</td>
                <td class="py-2 px-4">{{ $sale->payment_method }}</td>
                <td class="py-2 px-4">{{ date_format($sale->created_at, 'd/m/Y H:i:s') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
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
    const profitMargin = document.getElementById('profitMargin');
    const numberSalesPerEmployee = document.getElementById('numberSalesPerEmployee');
    const topSellingProducts = document.getElementById('topSellingProducts');
    const NumberSalesPerPaymentMethod = document.getElementById('NumberSalesPerPaymentMethod');

    const style = getComputedStyle(document.body);

    Chart.defaults.font.family = style.getPropertyValue('--font-family-default');
    Chart.defaults.font.weight = 500;
    

    const optionsChartTypeLine = {
      locale: 'pt-br',
      devicePixelRatio: 4,
      responsive: true,
      maintainAspectRatio: false,
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
      layout: {
        padding: 20
      },
      animation: false
    }

    new Chart(profit, {
      type: 'line',
      data: {
        labels: [{!! $saleDates !!}],
        datasets: [{
          label: 'Lucro',
          data: [{{ $profits }}],
          borderWidth: style.getPropertyValue('--graphics-border-width'),
          backgroundColor: style.getPropertyValue('--graphics-bg-color'),
          color: style.getPropertyValue('--color-graphics'),
          borderColor: style.getPropertyValue('--graphics-border-color'),
        }]
      },
      options: optionsChartTypeLine,
    });

    new Chart(salesQuantity, {
      type: 'line',
      data: {
        labels: [{!! $saleDates !!}],
        datasets: [{
          label: 'Vendas',
          data: [{{ $salesQuantity }}],
          borderWidth: style.getPropertyValue('--graphics-border-width'),
          backgroundColor: style.getPropertyValue('--graphics-bg-color'),
          color: style.getPropertyValue('--color-graphics'),
          borderColor: style.getPropertyValue('--graphics-border-color'),
        }]
      },
      options: optionsChartTypeLine,
    });

    new Chart(grossRevenue, {
      type: 'line',
      data: {
        labels: [{!! $saleDates !!}],
        datasets: [{
          label: 'Faturamento',
          data: [{{ $grossRevenues }}],
          borderWidth: style.getPropertyValue('--graphics-border-width'),
          backgroundColor: style.getPropertyValue('--graphics-bg-color'),
          color: style.getPropertyValue('--color-graphics'),
          borderColor: style.getPropertyValue('--graphics-border-color'),
        }]
      },
      options: optionsChartTypeLine,
    });

    new Chart(profitMargin, {
      type: 'line',
      data: {
        labels: [{!! $saleDates !!}],
        datasets: [{
          label: 'Margem',
          data: [{{ $profitMargins }}],
          borderWidth: style.getPropertyValue('--graphics-border-width'),
          backgroundColor: style.getPropertyValue('--graphics-bg-color'),
          color: style.getPropertyValue('--color-graphics'),
          borderColor: style.getPropertyValue('--graphics-border-color'),
        }]
      },
      options: optionsChartTypeLine,
    });

    new Chart(numberSalesPerEmployee, {
      type: 'bar',
      data: {
        labels: [{!! $usersNames !!}],
        datasets: [{
          label: 'Quantidade de vendas por funcionário',
          data: [{{ $numberSalesPerEmployee }}],
          borderWidth: style.getPropertyValue('--graphics-border-width'),
          backgroundColor: style.getPropertyValue('--graphics-bg-color'),
          color: style.getPropertyValue('--color-graphics'),
          borderColor: style.getPropertyValue('--graphics-border-color'),
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        devicePixelRatio: 4,
        scales: {
          y: {
            beginAtZero: true,
          },
          x: {
            grid: {
              display: false
            },
          },
        },
        layout: {
          padding: 20
        },
        animation: false
      }
    });

    new Chart(topSellingProducts, {
      type: 'doughnut',
      data: {
        labels: [{!! $productsNames !!}],
        datasets: [{
          label: 'Produtos mais vendidos',
          data: [{{ $topSellingProducts }}],
          borderWidth: style.getPropertyValue('--graphics-border-width'),
          backgroundColor: style.getPropertyValue('--graphics-bg-color'),
          color: style.getPropertyValue('--color-graphics'),
          borderColor: style.getPropertyValue('--graphics-border-color'),
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
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
        layout: {
          padding: 20
        },
        animation: false
      }
    });

    new Chart(NumberSalesPerPaymentMethod, {
      type: 'bar',
      data: {
        labels: [{!! $paymentMethodsNames !!}],
        datasets: [{
          label: 'Quantidade de vendas por forma de pagamento',
          data: [{{ $NumberSalesPerPaymentMethods }}],
          borderWidth: style.getPropertyValue('--graphics-border-width'),
          backgroundColor: style.getPropertyValue('--graphics-bg-color'),
          color: style.getPropertyValue('--color-graphics'),
          borderColor: style.getPropertyValue('--graphics-border-color'),
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        devicePixelRatio: 4,
        indexAxis: 'y',
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              display: false
            },
          },
        },
        layout: {
          padding: 20
        },
        animation: false
      }
    });
  </script>
@endpush
