<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;

// Halaman Utama
Route::get('/', [MovieController::class, 'index'])->name('home');


// Auth Routes
Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// Group: Authenticated User
Route::middleware(['auth'])->group(function () {

    // Tambah Movie
    Route::get('/movie/create', [MovieController::class, 'create'])->name('movie.create');
    Route::post('/movie/store', [MovieController::class, 'store'])->name('movie.store');

    // Edit & Update Movie
    Route::get('/movie/{id}/edit', [MovieController::class, 'edit'])->name('movie.edit');
    Route::put('/movie/{id}/update', [MovieController::class, 'update'])->name('movie.update');

    // Delete Movie
    Route::delete('/movie/{id}/delete', [MovieController::class, 'destroy'])->name('movie.destroy');
});

// Group: Admin Only
Route::middleware(['auth', RoleAdmin::class])->group(function () {
    Route::get('/admin/datamovie', [MovieController::class, 'dataMovie'])->name('admin.datamovie');
    
});

// routes/web.php
// Route::get('/movie/{id}', [MovieController::class, 'show'])->name('detail');

// Detail Movie (HARUS diletakkan PALING BAWAH karena dinamis)
Route::get('/movie/{id}/{slug}', [MovieController::class, 'detail_movie'])->name('movie.detail');

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
