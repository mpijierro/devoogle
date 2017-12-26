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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::get('/create-media', \Mulidev\Http\Controllers\Media\CreateMediaController::class)->name('create-media');
Route::get('/create-media', "Media\CreateMediaController")->name('create-media');
Route::post('/create-media', "Media\StoreMediaController")->name('store-media');

