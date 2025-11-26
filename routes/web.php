<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\LokasiController;




Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/tamu/dashboard', function () {
    session(['role' => 'tamu']);
    return redirect()->route('dashboard');
})->name('tamu.dashboard');


Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');


Route::resource('pengajuan', PengajuanController::class);
Route::resource('lokasi', LokasiController::class);

Route::resource('petugas', PetugasController::class);


Route::patch('/pengajuan/{id}/status', [PengajuanController::class, 'updateStatus'])
    ->name('pengajuan.updateStatus');




Route::get('/notifikasi/baca-semua', function () {
    auth()->user()?->unreadNotifications->markAsRead();
    return back();
})->name('notif.readall');

Route::get('/notif/read-all', function () {
    $admin = \App\Models\User::where('role', 'admin')->first();
    if ($admin) {
        $admin->unreadNotifications->markAsRead();
    }
    return back();
})->name('notif.readAll');