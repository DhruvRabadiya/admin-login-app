<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::controller(UserController::class)->group(function () {
    Route::get('/profile','profilePage')->name('profile')->middleware('AuthUser');
    Route::get('/allUsers', 'allUsers')->name('allUsers');
    Route::post('/addUser' ,'addUser')->name('addUser');
    Route::get('/editUser/{id}', 'editUser')->name('editUser');
    Route::delete('/deleteUser/{id}', 'deleteUser')->name('deleteUser');
    Route::post('users/changePassword', 'changePassword')->name('changePassword');
});

Route::controller(CategoryController::class)->group(function (){
    Route::get('/category' , 'category')->name('category')->middleware('AuthUser');
});

Route::controller(AuthController::class)->group(function () {

    Route::get('/signup',  'signupPage')->name('signup');
    Route::post('/signup',  'storeData')->name('signup.post');


    Route::get('/login',  'loginPage')->name('login');
    Route::post('/login', 'loginUser')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});
