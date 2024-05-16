<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'loginPage'])->name('Login');

Route::post('/login', [LoginController::class, 'storeData']);
