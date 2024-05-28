@extends('master')

@section('title', 'Web Scraping b6-Visualisasi Wilayah')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Wilayah Penjualan</h6>
        </div>
        <canvas id="salesChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx1 = document.getElementById('salesChart').getContext('2d');
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