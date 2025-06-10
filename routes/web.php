<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/', [MovieController::class, 'homePage']);
Route::get('movie/{id}/{slug}', [MovieController::class, 'detail']);
Route::get('data_movie', [MovieController::class, 'dataMovie'])->name('dataMovie');
Route::get('create-movie', [MovieController::class, 'create'])->name('createMovie')->middleware('auth');
Route::post('/movie', [MovieController::class, 'store'])->middleware('auth');
Route::get('/editmovie/{id}', [MovieController::class, 'edit'])->middleware('auth', RoleAdmin::class);
Route::post('/movie-update/{id}', [MovieController::class, 'update'])->middleware('auth', RoleAdmin::class);
Route::post('/movie-delete/{id}', [MovieController::class, 'delete'])->middleware('auth');



