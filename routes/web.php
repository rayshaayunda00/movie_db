<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/', [MovieController::class, 'index']);

Route::get('/movie/{id}/{slug}', [MovieController::class, 'detail_movie']);

Route::get('/movie/create', [MovieController::class, 'create'])->middleware('auth');

Route::post('/movie/store',[MovieController::class,'store'])->middleware('auth');

Route::get('/login', [AuthController::class,'formLogin'])->name('login');

Route::post('/login', [AuthController::class,'login']);

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');


Route::get('/admin/datamovie', [MovieController::class, 'dataMovie'])->name('admin.datamovie');

Route::get('/admin/datamovie', [MovieController::class, 'dataMovie']);

// Edit Movie
Route::get('/movie/{id}/edit', [MovieController::class, 'edit'])->middleware('auth')->name('movie.edit');

// Update Movie
Route::put('/movie/{id}/update', [MovieController::class, 'update'])->middleware('auth');

// Delete Movie
Route::delete('/movie/{id}/delete', [MovieController::class, 'destroy'])->middleware('auth');

