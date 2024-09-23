<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;

Route::get('/accueil', function () {
    return view('accueil');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/accueil', function () {
    return view('accueil');
})->name('accueil');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/profiles/create', [ProfileController::class, 'showCreateForm'])
    ->middleware('auth:sanctum')
    ->name('profiles.create.form');


Route::post('/profiles', [ProfileController::class, 'create'])
    ->middleware('auth:sanctum')
    ->name('profiles.create');

Route::get('/profiles/list', [ProfileController::class, 'showListActif'])
    ->middleware('auth:sanctum')
    ->name('profiles.list');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('logout');


Route::middleware('auth:sanctum')->put('/profiles/{id}', [ProfileController::class, 'update']);
