<?php

use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/signup', [SignupController::class, 'signupPage'])->name('signup');

Route::post('/signup', [SignupController::class, 'storeData'])->name('signup');
