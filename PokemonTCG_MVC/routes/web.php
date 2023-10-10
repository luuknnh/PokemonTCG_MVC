<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    // User
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');
    Route::get('/users/delete/{id}', 'App\Http\Controllers\UserController@delete')->name('users.delete');


    // Home
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
});

Auth::routes();

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
