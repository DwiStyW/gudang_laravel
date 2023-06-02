<?php

use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\masterbarangController;
use App\Http\Controllers\MasterGolonganController;
use App\Http\Controllers\MasterJenisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/sa', function () {
    return view('layouts.ui-sweet-alert');
});
Route::get('/a', function () {
    return view('layouts.ui-alerts');
});
Route::get('/icon', function () {
    return view('layouts.icons-unicons');
});
Route::get('/pb', function () {
    return view('layouts.ui-progressbars');
});
Route::get('/', function () {
    return view('dashboard.dashboard');
});
//dashboard
Route::get('dashboard', [DashboardController::class, 'index']);

//master-barang
Route::get('master-barang', [masterbarangController::class, 'index']);
Route::get('master-barang/add', [masterbarangController::class, 'create']);
Route::post('master-barang/store', [masterbarangController::class, 'store']);
Route::get('master-barang/show/{id}', [masterbarangController::class, 'show']);
Route::get('master-barang/edit/{id}', [masterbarangController::class, 'edit']);
Route::post('master-barang/update/{id}', [masterbarangController::class, 'update']);
Route::get('master-barang/delete/{id}', [masterbarangController::class, 'destroy']);

//master-jenis
Route::get('master-jenis', [MasterJenisController::class, 'index']);
Route::get('master-jenis/add', [MasterJenisController::class, 'create']);
Route::post('master-jenis/store', [MasterJenisController::class, 'store']);
Route::get('master-jenis/show/{id}', [MasterJenisController::class, 'show']);
Route::get('master-jenis/edit/{id}', [MasterJenisController::class, 'edit']);
Route::post('master-jenis/update/{id}', [MasterJenisController::class, 'update']);
Route::get('master-jenis/delete/{id}', [MasterJenisController::class, 'destroy']);

//master-golongan
Route::get('master-golongan', [MasterGolonganController::class, 'index']);
Route::get('master-golongan/add', [MasterGolonganController::class, 'create']);
Route::post('master-golongan/store', [MasterGolonganController::class, 'store']);
Route::get('master-golongan/show/{id}', [MasterGolonganController::class, 'show']);
Route::get('master-golongan/edit/{id}', [MasterGolonganController::class, 'edit']);
Route::post('master-golongan/update/{id}', [MasterGolonganController::class, 'update']);
Route::get('master-golongan/delete/{id}', [MasterGolonganController::class, 'destroy']);

//barang-masuk
Route::get('barang-masuk', [BarangmasukController::class, 'index']);
Route::get('barang-masuk/add', [BarangmasukController::class, 'create']);
Route::post('barang-masuk/store', [BarangmasukController::class, 'store']);
Route::get('barang-masuk/show/{id}', [BarangmasukController::class, 'show']);
Route::get('barang-masuk/edit/{id}', [BarangmasukController::class, 'edit']);
Route::post('barang-masuk/update/{id}', [BarangmasukController::class, 'update']);
Route::get('barang-masuk/delete/{id}', [BarangmasukController::class, 'destroy']);

//barang-keluar
Route::get('barang-keluar', [BarangkeluarController::class, 'index']);
Route::get('barang-keluar/add', [BarangkeluarController::class, 'create']);
Route::post('barang-keluar/store', [BarangkeluarController::class, 'store']);
Route::get('barang-keluar/show/{id}', [BarangkeluarController::class, 'show']);
Route::get('barang-keluar/edit/{id}', [BarangkeluarController::class, 'edit']);
Route::post('barang-keluar/update/{id}', [BarangkeluarController::class, 'update']);
Route::get('barang-keluar/delete/{id}', [BarangkeluarController::class, 'destroy']);