<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Pengembalian;
use App\Http\Controllers\Arsiptolak;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\TransportasiController;

use App\Http\Controllers\peminjam\HomepController;
use App\Http\Controllers\peminjam\TransportasipController;
use App\Http\Controllers\peminjam\BarangpController;
use App\Http\Controllers\peminjam\RuanganpController;
use App\Http\Controllers\peminjam\PeminjamanpController;
use App\Http\Controllers\peminjam\ArsipditolakpController;
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
    Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
    Route::put('/profil/update', [HomeController::class, 'updateProfil'])->name('profil.update');


    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman');
    Route::get('/tambahpeminjaman', [PeminjamanController::class, 'tambahpeminjaman'])->name('peminjaman.tambah');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

    Route::get('/pengembalian', [Pengembalian::class, 'pengembalian']);
    Route::get('/arsiptolak', [Arsiptolak::class, 'arsiptolak']);

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

    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan');
    Route::get('/tambahruangan', [RuanganController::class, 'tambahruangan'])->name('ruangan.tambah');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.delete');


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
        Route::get('/profilp', [HomepController::class, 'profil'])->name('profil');
        Route::put('/profilp/update', [HomepController::class, 'updateProfil'])->name('profil.update');

        Route::get('/peminjaman', [PeminjamanpController::class, 'index'])->name('peminjaman');

        Route::get('/tambahpeminjaman', [PeminjamanpController::class, 'tambahpeminjamanbarang'])->name('peminjaman.tambah');
        Route::get('/peminjaman/tambah/{idbarang?}', [PeminjamanpController::class, 'tambahpeminjamanbarang'])->name('peminjam.peminjaman.tambah');
        Route::post('/peminjaman', [PeminjamanpController::class, 'storebar'])->name('peminjaman.storebar');

         // Tambahkan router untuk transportasi di sini
         Route::get('/tambahpeminjamantrans', [PeminjamanpController::class, 'tambahPeminjamanTransportasi'])->name('peminjamantrans.tambah');
         Route::post('/peminjamantrans/store', [PeminjamanpController::class, 'storetrans'])->name('peminjamantrans.store');

        Route::get('/peminjaman/{id}/edit', [PeminjamanpController::class, 'edit'])->name('peminjaman.edit');
        Route::put('/peminjaman/{id}', [PeminjamanpController::class, 'update'])->name('peminjaman.update');
        Route::delete('/peminjaman/{id}', [PeminjamanpController::class, 'destroy'])->name('peminjaman.destroy');

        Route::get('/barang', [BarangpController::class, 'index'])->name('barang');
        Route::get('/barang/search', [BarangpController::class, 'search'])->name('barang.search');

        Route::get('/transportasi', [TransportasipController::class, 'index'])->name('transportasi');
        Route::get('/transportasi/search', [TransportasipController::class, 'search'])->name('transportasi.search');

        Route::get('/ruangan', [RuanganpController::class, 'index'])->name('ruangan');
        Route::get('/ruangan/search', [RuanganpController::class, 'search'])->name('ruangan.search');

        Route::get('/arsipditolak', [ArsipditolakpController::class, 'index'])->name('arsipditolak');

        // Tambahkan rute khusus peminjam lainnya di sini...
    });




