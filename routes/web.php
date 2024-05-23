<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::controller(UserController::class)->group(function () {
    Route::get('/profile','profilePage')->name('profile')->middleware('AuthUser');
    Route::get('/allUsers', 'allUsers')->name('allUsers');
    Route::post('/addUser' ,'addUser')->name('addUser');
});
Route::controller(AuthController::class)->group(function () {

    Route::get('/signup',  'signupPage')->name('signup');
    Route::post('/signup',  'storeData')->name('signup.post');


    Route::get('/login',  'loginPage')->name('login');
    Route::post('/login', 'loginUser')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});
