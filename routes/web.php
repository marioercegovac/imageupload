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

use \Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('index');
    Route::get('/', 'HomeController@index');
    Route::post('/upload', 'ImageController@store')->name('storeImage');
    Route::get('/preview/{id}', 'ImageController@showOriginal');
    Route::get('/modify/{id}', 'ImageController@modify');

});