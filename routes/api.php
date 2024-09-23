<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;


Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/profiles.create', [ProfileController::class, 'store']);



