<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::controller(UserController::class)->group(function () {
    Route::get('/profile', 'profilePage')->name('profile')->middleware('AuthUser');
    Route::get('/allUsers', 'allUsers')->name('allUsers');
    Route::post('/addUser', 'addUser')->name('addUser');
    Route::get('/editUser/{id}', 'editUser')->name('editUser');
    Route::delete('/deleteUser/{id}', 'deleteUser')->name('deleteUser');
    Route::post('users/changePassword', 'changePassword')->name('changePassword');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'category')->name('category')->middleware('AuthUser');
    Route::post('/addCategory', 'addCategory')->name('addCategory');
    Route::delete('/deleteCategory/{id}', 'deleteCategory')->name('deleteCategory');
    Route::get('/subcategory/{id}', 'subcategories')->name('subcategory');
    Route::get('/editCategory/{id}', 'editCategory')->name('editCategory');
    Route::put('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
    Route::post('/addSubCategory', 'addSubCategory')->name('addSubCategory');
});
Route::controller(ProductController::class)->group(function () {
    route::get('/products', 'products')->name('products')->middleware('AuthUser');
    Route::post('addProducts', 'addProduct')->name('addProduct');
    Route::get('/editProduct/{id}', 'editProduct')->name('editProduct');

    Route::put('/toggleStatus/{id}', 'toggleStatus')->name('toggleStatus');
    Route::delete('/deleteProduct/{id}', 'deleteProduct')->name('deleteProduct');

});
Route::controller(AuthController::class)->group(function () {

    Route::get('/signup',  'signupPage')->name('signup');
    Route::post('/signup',  'storeData')->name('signup.post');


    Route::get('/login',  'loginPage')->name('login');
    Route::post('/login', 'loginUser')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});
