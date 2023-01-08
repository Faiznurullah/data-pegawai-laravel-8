<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PegawaiController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('pegawai', [PegawaiController::class, 'get']);
Route::get('pegawai/{id}', [PegawaiController::class, 'get']);
Route::post('pegawai', [PegawaiController::class, 'store']);
Route::put('pegawai/{id}', [PegawaiController::class, 'update']);
Route::delete('pegawai/{id}', [PegawaiController::class, 'destroy']);