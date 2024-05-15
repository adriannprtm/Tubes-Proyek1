@extends('master')

@section('title', 'Web Scraping B6-Produk')

@section('content')
    <div class="container-fluid px-4 pt-4">
        <div class="row">
            @foreach($data as $product)
                <div class="col-md-4 mb-4">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product[1] }}</h5> <!-- Product name -->
                            <p class="card-text">Harga: {{ $product[2] }}</p> <!-- Product price -->
                            <p class="card-text">Dikirim dari: {{ $product[3] }}</p> <!-- Product price -->
                            <p class="card-text">Toko: {{ $product[4] }}</p> <!-- Product price -->
                            <p class="card-text">Penilaian: {{ $product[5] }}</p> <!-- Product price -->
                            <p class="card-text">Terjual: {{ $product[6] }}</p> <!-- Product URL -->
                            <p class="card-text">Link Penjualan: <a href="{{ $product[7] }}">Tekan Disini</a></p> <!-- Product price -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
