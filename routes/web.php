<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get("/", [LoginController::class,"index"]);

/*-------------------------------------- Admin Access --------------------------------------*/


// login and register
Route::get("/login", [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post("/login", [LoginController::class, 'authenticate']);
Route::post("/logout", [LoginController::class, 'logout']);
Route::get("/register", [RegisterController::class, 'index'])->middleware('guest');
Route::post("/register", [RegisterController::class, 'store']);
// login and register


Route::resource("bukus", BukuController::class)->middleware('auth');
Route::get('/home', [DashboardController::class, 'index'])->middleware('auth');


// list book
Route::get('/list-book', [DashboardController::class, 'listBook'])->middleware('auth');
Route::get('/storeToCart/{id_buku}', [DashboardController::class, 'storeToCart'])->name('storeToCart')->middleware('auth');
Route::get('/showData/{id_buku}', [DashboardController::class, 'show'])->name('showData')->middleware('auth');
// list book


// list Cart
Route::get('/viewCart', [DashboardController::class, 'viewCart'])->middleware('auth');
Route::delete('/delete/{id}', [DashboardController::class, 'destroy'])->name('delete')->middleware('auth');
Route::post('/increaseQuantity/{id}', [DashboardController::class, 'increaseQuantity'])->name('increaseQuantity')->middleware('auth');
Route::post('/decreaseQuantity/{id}', [DashboardController::class, 'decreaseQuantity'])->name('decreaseQuantity')->middleware('auth');
Route::post('/pinjam-buku', [DashboardController::class, 'pinjamBuku'])->name('pinjam-buku')->middleware('auth');
// list Cart


// list borrow
Route::get('/viewBorrow', [DashboardController::class, 'viewBorrow'])->middleware('auth');
Route::get('/viewBorrow/search', [DashboardController::class, 'search'])->name('search');
Route::delete('/return/{id}', [DashboardController::class, 'returnBook'])->name('return')->middleware('auth');
Route::get('/cetak_pdf/{nama}', [DashboardController::class, 'cetak_pdf'])->name('cetak_pdf')->middleware('auth');
// list borrow


/*-------------------------------------- Admin Access --------------------------------------*/
