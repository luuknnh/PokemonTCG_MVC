<?php

use Illuminate\Support\Facades\Route;


// Users for development
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::get('/users/create', 'App\Http\Controllers\UserController@create');
Route::post('/users', 'App\Http\Controllers\UserController@store');



