<?php

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ExportController;

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


// Login
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Proses Login
Route::post('/proseslogin', [LoginController::class, 'proseslogin']);

// Logout
Route::get('/logout', [LoginController::class, 'logout']);

// Show
Route::get('/', [PagesController::class, 'index'])->name('index')->middleware('auth');
Route::get('/home', [PagesController::class, 'index'])->name('index')->middleware('auth');

//Detail
Route::get('/detail/{id}', [PagesController::class, 'detail'])->name('detail')->middleware('auth');


// to halaman post
Route::get('/tambah', [PagesController::class, 'tambah'])->name('tambah')->middleware('auth');

// Tambah data
Route::post('/insert', [PagesController::class, 'insert'])->name('insert')->middleware('auth');


//Dapatkan Data Edit
Route::get('/edit/{id}', [PagesController::class, 'edit'])->name('edit')->middleware('auth');

//Update Data
Route::post('/update/{id}', [PagesController::class, 'update'])->name('update')->middleware('auth');


// Hapus Data
Route::get('/hapus/{id}', [PagesController::class, 'hapus'])->name('hapus')->middleware('auth');


// Download Data PDF
Route::get('/downloadpdf', [ExportController::class, 'downloadpdf'])->name('downloadpdf')->middleware('auth');







