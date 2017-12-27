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

Route::group(['prefix' => 'resource'], function () {

    Route::get('/', "Resource\HomeResourceController")->name('home-resource');

    Route::get('/create', "Resource\CreateResourceController")->name('create-resource');
    Route::post('/create', "Resource\StoreResourceController")->name('store-resource');

    Route::get('/edit/{uuid}', "Resource\EditResourceController")->name('edit-resource');
    Route::post('/edit/{uuid}', "Resource\UpdateResourceController")->name('update-resource');

    Route::get('/delete/{uuid}', "Resource\DeleteResourceController")->name('delete-resource');

});
