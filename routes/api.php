<?php

use App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PegawaiController;

Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    
Route::post('/logout', [ApiController::class, 'logout']);
Route::get('pegawai', [PegawaiController::class, 'get']);
Route::get('pegawai/{id}', [PegawaiController::class, 'get']);
Route::post('pegawai', [PegawaiController::class, 'store']);
Route::put('pegawai/{id}', [PegawaiController::class, 'update']);
Route::delete('pegawai/{id}', [PegawaiController::class, 'destroy']);

    });





