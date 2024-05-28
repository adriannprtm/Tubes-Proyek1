<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\VisualisasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login_form');
});
Route::get('login_form', [AuthController::class, 'showLoginForm'])->name('login_form');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('dashboard', 'DashboardController@index')->middleware('auth');
Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('produk', [ProdukController::class, 'produk'])->name('produk')->middleware('auth');
Route::get('produk_table', [ProdukController::class, 'produk_table'])->name('produk_table')->middleware('auth');
Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');

Route::get('wilayah', [VisualisasiController::class, 'wilayah'])->name('wilayah')->middleware('auth');
Route::get('produkTerlaris', [VisualisasiController::class, 'produkTerlaris'])->name('produkTerlaris')->middleware('auth');
Route::get('brandTerlaris', [VisualisasiController::class, 'brandTerlaris'])->name('brandTerlaris')->middleware('auth');