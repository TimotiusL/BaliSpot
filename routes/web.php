<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/home', [UserController::class, 'index']);