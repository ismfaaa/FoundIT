<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;

// Halaman yang bisa diakses tanpa login
Route::get('/', [UserController::class, 'index'])->name('landing');
Route::get('/home', [UserController::class, 'home'])->name('home');

// Route Autentikasi (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route yang hanya bisa diakses SETELAH LOGIN
Route::middleware('auth')->group(function () {
    
    // =================================== Daftar & Upload Barang ===================================
    Route::get('/upload', [ItemController::class, 'create'])->name('upload');
    Route::post('/upload', [ItemController::class, 'store'])->name('upload.store');
    Route::get('/item', [ItemController::class, 'index'])->name('items.index');

    // =================================== Profile & Activity ===================================
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile']);
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
    Route::put('/profile/update-photo', [UserController::class, 'updateFoto'])->name('profile.updateFoto')->middleware('auth');
    Route::get('/my-activity', [UserController::class, 'activity'])->name('activity');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // =================================== Klaim Barang ===================================
    // untuk klaim barang
    Route::get('/claim/{item_id}', [ItemController::class, 'showClaimForm'])->name('claim.form');
    Route::post('/claim/{item_id}', [ItemController::class, 'processClaim'])->name('claim.store');

  
    // =================================== Untuk Verifikasi Klaim dan Chat ===================================
    // Menampilkan daftar klaim yang masuk ke barang milik user
   
    Route::get('/verification', [VerifikasiController::class, 'index'])->name('verification');

    // Penemu menyetujui klaim dan membuka jalur Chat (Verifikasi)
    Route::post('/claim/{id}/approve', [ClaimController::class, 'approve'])->name('claim.approve');
    Route::post('/claim/{id}/reject', [ClaimController::class, 'reject'])->name('claim.reject');
    
    // Fitur Chat antara Penemu & Pengklaim setelah klaim disetujui
    Route::get('/chat/{verifikasi_id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{verifikasi_id}', [ChatController::class, 'send'])->name('chat.send');
});

// // Halaman utama (Daftar Barang)
// // ItemController::class, 'index' ==> sebagai backup jika /items nya keliru maka akan di tujukan ke item (halaman utama)
// Route::get('/item', [ItemController::class, 'index'])->name('items.item');

// // langsung nambah diatas yg use App\Http\Controllers\TugasController; secara otomatis
// Route::get('/tugas',[TugasController::class, 'index']);

// // class index ini untuk menampilkan nya

// // get untuk mengambil sedang post untuk mengirim data