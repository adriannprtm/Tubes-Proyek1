<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function produk()
    {
        // Mendapatkan path ke file CSV
        $path = public_path('produk.csv');

        // Membuka file CSV
        $file = fopen($path, 'r');

        // Menginisialisasi array untuk menyimpan data
        $data = [];

        // Mengabaikan baris pertama (header)
        fgetcsv($file);

        // Membaca baris demi baris dari file CSV
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }

        // Menutup file CSV
        fclose($file);

        // Mengirimkan data ke view
        return view('produk', ['data' => $data]);
    }

    public function search(Request $request)
{
    $keyword = $request->input('search');

    $path = public_path('produk.csv');
    $file = fopen($path, 'r');
    $data = [];

    while (($row = fgetcsv($file)) !== false) {
        // Mencocokkan nama produk dengan kata kunci
        if (strpos(strtolower($row[1]), strtolower($keyword)) !== false) {
            $data[] = $row;
        }
    }

    fclose($file);

    return view('produkTabel', ['data' => $data]);
}

    public function produk_table()
    {
        // Mendapatkan path ke file CSV
        $path = public_path('produk.csv');

        // Membuka file CSV
        $file = fopen($path, 'r');

        // Menginisialisasi array untuk menyimpan data
        $data = [];

        // Mengabaikan baris pertama (header)
        fgetcsv($file);

        // Membaca baris demi baris dari file CSV
        while (($row = fgetcsv($file)) !== false) {
            $harga = floatval($row[3]);
            $row[3] = 'Rp ' . number_format($harga, 0, ',', '.');
            $data[] = $row;
        }

        // Menutup file CSV
        fclose($file);

        // Mengirimkan data ke view
        return view('produkTabel', ['data' => $data]);
    }
}

