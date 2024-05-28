@extends('master')

@section('title', 'Web Scraping B6-Produk')

@section('content')
    <div class="container-fluid px-4 pt-4">
        <div class="row">
            @foreach($data as $product)
                <div class="col-md-4 mb-4">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product[1] }}</h5>
                            <p class="card-text">Brand: {{ $product[2] }}</p> 
                            <p class="card-text">Harga:{{ $product[3] }}</p> 
                            <p class="card-text">Lokasi Toko: {{ $product[4] }}</p> 
                            <p class="card-text">Nama Toko: {{ $product[5] }}</p> 
                            <p class="card-text">Penilaian: {{ $product[6] }}</p> 
                            <p class="card-text">Stok: {{ $product[7] }}</p> 
                            <p class="card-text">Link Produk: <a href="{{ $product[8] }}">Tekan Disini</a></p> 
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
