<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('AuthUser')->group(function () {
    Route::view('/profile', 'profile')->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/signup',  'signupPage')->name('signup');

    Route::post('/signup',  'storeData')->name('signup.post');


    Route::get('/login',  'loginPage')->name('login');
    Route::post('/login', 'loginUser')->name('login.post');
});


