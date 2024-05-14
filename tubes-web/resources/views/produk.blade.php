@extends('master')

@section('title', 'Web Scraping B6-Produk')

@section('content')
            <div class="container-fluid px-4 pt-4">
                <div class="row">
                    @for($i = 1; $i <= 12; $i++)
                        <div class="col-md-4 mb-4">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title">Product {{ $i }}</h5>
                                    <p class="card-text">Price: ${{ rand(10, 100) }}</p>
                                    <p class="card-text">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
@endsection