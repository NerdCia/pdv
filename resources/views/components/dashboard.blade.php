@extends('layouts.master')

@section('title', 'Painel')


@section('content')

    <canvas class="w-100 bg-white rounded-5 p-5 my-3 shadow-lg" id="myChart"></canvas>

@endsection

@push('graphics')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 2,
          backgroundColor: '#ed3237',
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endpush
