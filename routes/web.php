<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\LokasiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('petugas', App\Http\Controllers\PetugasController::class);
Route::resource('pengajuan', App\Http\Controllers\PengajuanController::class);
Route::resource('lokasi', App\Http\Controllers\LokasiController::class);

Route::patch('pengajuan/{id}/status', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');