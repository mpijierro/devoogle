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


//Route::get('/create-resource', \Mulidev\Http\Controllers\Resource\CreateResourceController::class)->name('create-resource');

Route::get('/resource', "Resource\HomeResourceController")->name('home-resource');

Route::get('/create-resource', "Resource\CreateResourceController")->name('create-resource');
Route::post('/create-resource', "Resource\StoreResourceController")->name('store-resource');

Route::get('/edit-resource/{resource}', "Resource\EditResourceController")->name('edit-resource');
Route::post('/edit-resource/{resource}', "Resource\UpdateResourceController")->name('update-resource');
