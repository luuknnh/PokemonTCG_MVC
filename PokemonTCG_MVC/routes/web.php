<?php

use Illuminate\Support\Facades\Route;


// Users for development
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::get('/users/create', 'App\Http\Controllers\UserController@create');
Route::post('/users', 'App\Http\Controllers\UserController@store');




Auth::routes();

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
