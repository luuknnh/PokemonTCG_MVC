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
// Toon het formulier voor het toevoegen van een kaart
Route::get('/createcard', 'App\Http\Controllers\CardController@create')->name('cards.create');

// Verwerk het toevoegen van de kaart
Route::post('/createcard', 'App\Http\Controllers\CardController@store')->name('cards.store');

Route::get('/card/{id}', 'App\Http\Controllers\CardController@show')->name('cards.show');



});

Auth::routes();

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
