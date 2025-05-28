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
