<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::view('/profile', 'profile')->name('profile')->middleware('AuthUser');
Route::controller(AuthController::class)->group(function(){

    Route::get('/signup',  'signupPage')->name('signup');
    
    Route::post('/signup',  'storeData')->name('signup.post');
    
    
    Route::get('/login',  'loginPage')->name('login');
    Route::post('/login', 'loginUser')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});


