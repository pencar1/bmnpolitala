<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Peminjaman;
use App\Http\Controllers\Pengembalian;
use App\Http\Controllers\Arsiptolak;
use App\Http\Controllers\Barang;
use App\Http\Controllers\Ruangan;
use App\Http\Controllers\Transportasi;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class, 'dashboard']);

Route::get('/peminjaman', [Peminjaman::class, 'peminjaman']);
Route::get('/pengembalian', [Pengembalian::class, 'pengembalian']);
Route::get('/arsiptolak', [Arsiptolak::class, 'arsiptolak']);
Route::get('/barang', [Barang::class, 'barang']);
Route::get('/ruangan', [Ruangan::class, 'ruangan']);
Route::get('/transportasi', [Transportasi::class, 'transportasi']);


Route::get('/user', [HomeController::class, 'index'])->name('index');

Route::get('/create', [HomeController::class, 'create'])->name('user.create');
Route::post('/store', [HomeController::class, 'store'])->name('user.store');

Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
Route::put('/update/{id}', [HomeController::class, 'update'])->name('user.update');

Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('user.delete');
