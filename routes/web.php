<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('AuthUser')->group(function () {
    Route::view('/profile', 'profile')->name('profile');
});
Route::get('/signup', [AuthController::class, 'signupPage'])->name('signup');

Route::post('/signup', [AuthController::class, 'storeData'])->name('signup.post');


Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.post');
