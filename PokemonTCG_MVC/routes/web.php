<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    // User
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');
    Route::get('/users/delete/{id}', 'App\Http\Controllers\UserController@delete')->name('users.delete');


    // Home
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

    // Cards
    Route::get('/cards', 'App\Http\Controllers\CardController@index')->name('cards.index');
    Route::get('/cards/create', 'App\Http\Controllers\CardController@create')->name('cards.create');
    Route::post('/searchcard', 'App\Http\Controllers\CardController@searchCard')->name('cards.search');
    Route::post('/cards/create', 'App\Http\Controllers\CardController@store')->name('cards.store');
    Route::get('/card/{id}', 'App\Http\Controllers\CardController@show')->name('cards.show');


// Collection
    Route::get('/collections', 'App\Http\Controllers\CollectionController@index')->name('collections.index');
    Route::get('/collections/owned', 'App\Http\Controllers\CollectionController@owned')->name('collections.owned');
    Route::get('/collections/create', 'App\Http\Controllers\CollectionController@create');
    Route::post('/collections', 'App\Http\Controllers\CollectionController@store')->name('collections.store');
    Route::get('/collections/{id}', 'App\Http\Controllers\CollectionController@show')->name('collections.show');
    Route::post('/collections/{id}/updateStatus', 'App\Http\Controllers\CollectionController@updateStatus')->name('collections.updateStatus');





});

Auth::routes();

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');