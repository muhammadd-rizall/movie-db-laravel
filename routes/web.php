<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/',[MovieController::class, 'homePage']);
Route::get('movie/{id}/{slug}', [MovieController::class, 'detail']);
Route::get('create-movie',[MovieController:: class, 'create'])->name('createMovie');
Route::post('/movie',[MovieController::class, 'store']);




