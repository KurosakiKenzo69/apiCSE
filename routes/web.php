<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;

// Route pour la page d'accueil
Route::get('/accueil', function () {
    return view('accueil');
})->name('accueil');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profiles/create', [ProfileController::class, 'showCreateForm'])->name('profiles.create.form');

    Route::post('/profiles', [ProfileController::class, 'create'])->name('profiles.create');

    Route::get('/profiles/list', [ProfileController::class, 'showListActif'])->name('profiles.list');

    Route::get('/profiles/edit', [ProfileController::class, 'listForEdit'])->name('profiles.list.edit');
    Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');

// Route pour mettre à jour un profil
    Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');

// Route pour supprimer un profil
    Route::delete('/profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
});
