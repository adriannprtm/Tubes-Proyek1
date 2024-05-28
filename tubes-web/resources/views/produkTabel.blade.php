@extends('master')

@section('title', 'Web Scraping B6-Tabel Produk')

@section('content')
<div class="container-fluid px-4 pt-4">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Tabel Produk</h6>
        <!-- Formulir pencarian -->
        <form action="{{ route('produk.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama produk...">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
        <div class="table-responsive">
            <table id="produkTable" class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Lokasi Toko</th>
                        <th scope="col">Nama Toko</th>
                        <th scope="col">Penilaian</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Link Produk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $produk)
                    <tr>
                        <td>{{ $produk[1] }}</td>
                        <td>{{ $produk[2] }}</td>
                        <td>{{ $produk[3] }}</td>
                        <td>{{ $produk[4] }}</td>
                        <td>{{ $produk[5] }}</td>
                        <td>{{ $produk[6] }}</td>
                        <td>{{ $produk[7] }}</td>
                        <td><a href="{{ $produk[8] }}">Klik Disini</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#produkTable').DataTable({
            "paging": true,
            "searching": true,
        });
    });
</script>
@endsection
