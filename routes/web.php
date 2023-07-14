<?php

use App\Http\Controllers\AprioriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
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
// auth
Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout']);

//dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');

//master-barang
Route::get('master-barang', [masterbarangController::class, 'index'])->middleware('auth');
Route::get('master-barang/add', [masterbarangController::class, 'create'])->middleware('auth');
Route::post('master-barang/store', [masterbarangController::class, 'store'])->middleware('auth');
Route::get('master-barang/show/{id}', [masterbarangController::class, 'show'])->middleware('auth');
Route::get('master-barang/edit/{id}', [masterbarangController::class, 'edit'])->middleware('auth');
Route::post('master-barang/update/{id}', [masterbarangController::class, 'update'])->middleware('auth');
Route::get('master-barang/delete/{id}', [masterbarangController::class, 'destroy'])->middleware('auth');

//master-jenis
Route::get('master-jenis', [MasterJenisController::class, 'index'])->middleware('auth');
Route::get('master-jenis/add', [MasterJenisController::class, 'create'])->middleware('auth');
Route::post('master-jenis/store', [MasterJenisController::class, 'store'])->middleware('auth');
Route::get('master-jenis/show/{id}', [MasterJenisController::class, 'show'])->middleware('auth');
Route::get('master-jenis/edit/{id}', [MasterJenisController::class, 'edit'])->middleware('auth');
Route::post('master-jenis/update/{id}', [MasterJenisController::class, 'update'])->middleware('auth');
Route::get('master-jenis/delete/{id}', [MasterJenisController::class, 'destroy'])->middleware('auth');

//master-golongan
Route::get('master-golongan', [MasterGolonganController::class, 'index'])->middleware('auth');
Route::get('master-golongan/add', [MasterGolonganController::class, 'create'])->middleware('auth');
Route::post('master-golongan/store', [MasterGolonganController::class, 'store'])->middleware('auth');
Route::get('master-golongan/show/{id}', [MasterGolonganController::class, 'show'])->middleware('auth');
Route::get('master-golongan/edit/{id}', [MasterGolonganController::class, 'edit'])->middleware('auth');
Route::post('master-golongan/update/{id}', [MasterGolonganController::class, 'update'])->middleware('auth');
Route::get('master-golongan/delete/{id}', [MasterGolonganController::class, 'destroy'])->middleware('auth');

//barang-masuk
Route::get('barang-masuk', [BarangmasukController::class, 'index'])->middleware('auth');
Route::get('barang-masuk/add', [BarangmasukController::class, 'create'])->middleware('auth');
Route::post('barang-masuk/store', [BarangmasukController::class, 'store'])->middleware('auth');
Route::get('barang-masuk/show/{id}', [BarangmasukController::class, 'show'])->middleware('auth');
Route::get('barang-masuk/edit/{id}', [BarangmasukController::class, 'edit'])->middleware('auth');
Route::post('barang-masuk/update/{id}', [BarangmasukController::class, 'update'])->middleware('auth');
Route::get('barang-masuk/delete/{id}', [BarangmasukController::class, 'destroy'])->middleware('auth');

//barang-keluar
Route::get('barang-keluar', [BarangkeluarController::class, 'index'])->middleware('auth');
Route::get('barang-keluar/add', [BarangkeluarController::class, 'create'])->middleware('auth');
Route::post('barang-keluar/store', [BarangkeluarController::class, 'store'])->middleware('auth');
Route::get('barang-keluar/show/{id}', [BarangkeluarController::class, 'show'])->middleware('auth');
Route::get('barang-keluar/edit/{id}', [BarangkeluarController::class, 'edit'])->middleware('auth');
Route::post('barang-keluar/update/{id}', [BarangkeluarController::class, 'update'])->middleware('auth');
Route::get('barang-keluar/delete/{id}', [BarangkeluarController::class, 'destroy'])->middleware('auth');

// apriori
Route::get('apriori', [AprioriController::class, 'index'])->middleware('auth');

// laporan
Route::get('riwayatkeluarmasuk',[LaporanController::class,'riwayatkeluarmasuk'])->middleware('auth');
Route::get('laporanpergolongan',[LaporanController::class,'laporanpergolongan'])->middleware('auth');
Route::get('laporanall',[LaporanController::class,'laporanall'])->middleware('auth');
Route::get('laporansaldoakhir',[LaporanController::class,'laporansaldoakhir'])->middleware('auth');

// carilaporan
Route::post('caririwayatkeluarmasuk',[LaporanController::class,'caririwayatkeluarmasuk'])->middleware('auth');
Route::post('caripergol',[LaporanController::class,'caripergol'])->middleware('auth');
Route::post('carisaldoakhir',[LaporanController::class,'carisaldoakhir'])->middleware('auth');
Route::post('cariall',[LaporanController::class,'cariall'])->middleware('auth');