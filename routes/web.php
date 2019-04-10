<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'MoviesController@index')->name('home');
Route::get('/افلام اجنبى', 'MoviesController@index')->name('movies.english');
Route::get('/افلام عربى', 'MoviesController@getArabicMovies')->name('movies.arabic');

Route::get('/{slug}', 'ServerLinksForMoviesController@index')->name('movie.serverLinks');
