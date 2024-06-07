<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Peminjaman;
use App\Http\Controllers\Pengembalian;
use App\Http\Controllers\Arsiptolak;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Ruangan;
use App\Http\Controllers\TransportasiController;

use App\Http\Controllers\peminjam\HomepController;
use App\Http\Controllers\peminjam\TransportasipController;
use App\Http\Controllers\peminjam\BarangpController;

use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route group for admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin'], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/ruangan', [Ruangan::class, 'ruangan']);
    Route::get('/peminjaman', [Peminjaman::class, 'peminjaman']);
    Route::get('/pengembalian', [Pengembalian::class, 'pengembalian']);
    Route::get('/arsiptolak', [Arsiptolak::class, 'arsiptolak']);
    Route::get('/barang', [Barang::class, 'barang']);

    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('/tambahbarang', [BarangController::class, 'tambahbarang'])->name('barang.tambah');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/transportasi', [TransportasiController::class, 'index'])->name('transportasi');
    Route::get('/tambahtransportasi', [TransportasiController::class, 'tambahtransportasi'])->name('transportasi.tambah');
    Route::post('/transportasi', [TransportasiController::class, 'store'])->name('transportasi.store');
    Route::get('/transportasi/{id}/edit', [TransportasiController::class, 'edit'])->name('transportasi.edit');
    Route::put('/transportasi/{id}', [TransportasiController::class, 'update'])->name('transportasi.update');
    Route::delete('/transportasi/{id}', [TransportasiController::class, 'destroy'])->name('transportasi.destroy');

    Route::get('/user', [HomeController::class, 'index'])->name('index');
    Route::get('/create', [HomeController::class, 'create'])->name('user.create');
    Route::post('/store', [HomeController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [HomeController::class, 'update'])->name('user.update');
    Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('user.delete');
});

// Route group for staf
Route::group(['prefix' => 'staf', 'middleware' => ['auth', 'role:staf'], 'as' => 'staf.'], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    // Tambahkan rute khusus staf lainnya di sini...
});

// Route group for peminjam
Route::group(['prefix' => 'peminjam', 'middleware' => ['auth', 'role:peminjam'], 'as' => 'peminjam.'], function () {
        Route::get('/dashboard', [HomepController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [HomepController::class, 'dashboard'])->name('dashboard');
        Route::get('/transportasi', [TransportasipController::class, 'index'])->name('transportasi');
        Route::get('/barang', [BarangpController::class, 'index'])->name('barang');
        // Tambahkan rute khusus peminjam lainnya di sini...
    });
    
    // Route group for wadir
    Route::group(['prefix' => 'wadir', 'middleware' => ['auth', 'role:wadir'], 'as' => 'wadir.'], function () {
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        // Tambahkan rute khusus wadir lainnya di sini...
    });
    