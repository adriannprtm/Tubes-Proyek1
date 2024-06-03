<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisualisasiController extends Controller
{
    public function wilayah(Request $request)
    {
        $csvPath = public_path('produk.csv');
        $file = fopen($csvPath, 'r');

        // Baca header
        $header = fgetcsv($file);

        $sales = [];
        while (($record = fgetcsv($file)) !== FALSE) {
            $row = array_combine($header, $record);
            $productName = $row['shop_location'];
            $productsSold = (int)$row['products_sold'];
            if (!isset($sales[$productName])) {
                $sales[$productName] = 0;
            }
            $sales[$productName] += $productsSold;
        }

        fclose($file);

        // Sort by products_sold in descending order
        arsort($sales);

        // Get the number of products to display from the request, default to 10
        $numProducts = $request->input('num_products', 10);

        // Get top N products
        $topSales = array_slice($sales, 0, $numProducts, true);

        $labels = array_keys($topSales);
        $data = array_values($topSales);

        return view('wilayah', compact('labels', 'data', 'numProducts'));
    }

    public function produkTerlaris(Request $request)
    {
        $csvPath = public_path('produk.csv');
        $file = fopen($csvPath, 'r');

        // Baca header
        $header = fgetcsv($file);

        $sales = [];
        while (($record = fgetcsv($file)) !== FALSE) {
            $row = array_combine($header, $record);
            $productName = $row['product_name'];
            $productsSold = (int)$row['products_sold'];
            if (!isset($sales[$productName])) {
                $sales[$productName] = 0;
            }
            $sales[$productName] += $productsSold;
        }

        fclose($file);

        // Sort by products_sold in descending order
        arsort($sales);

        // Get the number of products to display from the request, default to 10
        $numProducts = $request->input('num_products', 10);

        // Get top N products
        $topSales = array_slice($sales, 0, $numProducts, true);

        $labels = array_keys($topSales);
        $data = array_values($topSales);

        return view('produkTerlaris', compact('labels', 'data', 'numProducts'));
    }

    public function brandTerlaris(Request $request)
    {
        $csvPath = public_path('produk.csv');
        $file = fopen($csvPath, 'r');

        // Baca header
        $header = fgetcsv($file);

        $sales = [];
        while (($record = fgetcsv($file)) !== FALSE) {
            $row = array_combine($header, $record);
            $productName = $row['Brand'];
            $productsSold = (int)$row['products_sold'];
            if (!isset($sales[$productName])) {
                $sales[$productName] = 0;
            }
            $sales[$productName] += $productsSold;
        }

        fclose($file);

        // Sort by products_sold in descending order
        arsort($sales);

        // Get the number of products to display from the request, default to 10
        $numProducts = $request->input('num_products', 10);

        // Get top N products
        $topSales = array_slice($sales, 0, $numProducts, true);

        $labels = array_keys($topSales);
        $data = array_values($topSales);

        return view('brandTerlaris', compact('labels', 'data', 'numProducts'));
    }
}
