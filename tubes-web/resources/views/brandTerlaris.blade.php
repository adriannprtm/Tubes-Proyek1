@extends('master')

@section('title', 'Kelompok B6-Brand Terlaris')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Brand Terlaris</h6>
            <form method="GET" action="{{ url('/brandTerlaris') }}">
                <label for="num_products">Number of Products to Display:</label>
                <input type="number" id="num_products" name="num_products" value="{{ $numProducts }}" min="1">
                <button type="submit">Update</button>
            </form>
        </div>
        <canvas id="brandChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx1 = document.getElementById('brandChart').getContext('2d');
            var labels = @json($labels);
            var data = @json($data);

            var myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Total Products Sold",
                        data: data,
                        backgroundColor: "rgb(3,172,14, .7)"
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection