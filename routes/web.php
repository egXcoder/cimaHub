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
Route::get('/search', 'MoviesController@ajax_search')->name('home.search');
Route::get('/افلام-اجنبى', 'MoviesController@getMoviesEnglish')->name('movie.english');
Route::get('/افلام-هندى', 'MoviesController@getMoviesIndian')->name('movie.indian');
Route::get('/افلام-انمى', 'MoviesController@getMoviesAnimation')->name('movie.animation');
Route::get('/genre/{name}', 'MoviesController@getMoviesByGenre')->name('movie.genre');
Route::get('/{movie}', 'ServerLinksForMoviesController@index')->name('movie.single');