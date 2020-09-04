<?php

use Illuminate\Support\Facades\Route;

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

Route::fallback(function() {
    return view('error.404');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->middleware('auth')->name('dashboard');
Route::get('/post', 'PostController@index')->middleware('auth')->name('post');
Route::post('/post', 'PostController@store')->middleware('auth')->name('post.store');
Route::get('/post/{slug}', 'PostController@show')->middleware('auth')->name('post.show');
Route::put('/post/{slug}', 'PostController@update')->middleware('auth')->name('post.update');
//Route::delete('/post/{slug}', 'PostController@delete')->middleware('auth')->name('post.delete');
