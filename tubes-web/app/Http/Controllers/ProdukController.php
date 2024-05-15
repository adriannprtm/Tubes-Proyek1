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

        // Membaca baris demi baris dari file CSV
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }

        // Menutup file CSV
        fclose($file);

        // Mengirimkan data ke view
        return view('produk', ['data' => $data]);
    }
}

