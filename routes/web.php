<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\AuthController;

// Route Tamu (Hanya bisa diakses kalau BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route Utama yang Diproteksi (Harus Login dulu)
Route::middleware('auth')->group(function () {
    Route::get('/', [CourtController::class, 'index'])->name('coaches.index');
    Route::get('/coaches', [CourtController::class, 'index']);
    Route::post('/coaches', [CourtController::class, 'store'])->name('coaches.store');
    Route::put('/coaches/{id}', [CourtController::class, 'update'])->name('coaches.update');
    Route::delete('/coaches/{id}', [CourtController::class, 'destroy'])->name('coaches.destroy');

    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});