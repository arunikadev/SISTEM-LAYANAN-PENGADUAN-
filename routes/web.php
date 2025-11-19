<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProfileController;

// Rute 'tamu' seperti welcome page (jika ada)
Route::get('/', function () {
    return view('welcome');
});

// Ini adalah GRUP UNTUK USER YANG SUDAH LOGIN
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute Mahasiswa
    Route::get('/dashboard', [PengaduanController::class, 'index'])->name('dashboard');
    Route::get('/pengaduan/buat', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show'); Route::get('/statistik', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'statistik'])->name('statistik');

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Grup Admin
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::put('/pengaduan/{pengaduan}', [AdminDashboardController::class, 'update'])->name('pengaduan.update');
        Route::get('/statistik', [AdminDashboardController::class, 'statistik'])->name('statistik');
    });


}); 
require __DIR__.'/auth.php';