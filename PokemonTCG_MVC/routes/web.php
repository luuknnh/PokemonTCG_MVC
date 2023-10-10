<?php

use Illuminate\Support\Facades\Route;


// Users for development
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::get('/users/create', 'App\Http\Controllers\UserController@create');
Route::post('/users', 'App\Http\Controllers\UserController@store');




Auth::routes();

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
