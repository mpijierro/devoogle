<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth', 'prefix' => 'resource'], function () {

    Route::get('/', "Resource\HomeResourceController")->name('home-resource');

    Route::get('/create', "Resource\CreateResourceController")->name('create-resource');
    Route::post('/create', "Resource\StoreResourceController")->name('store-resource');

    Route::get('/edit/{uuid}', "Resource\EditResourceController")->name('edit-resource');
    Route::post('/edit/{uuid}', "Resource\UpdateResourceController")->name('update-resource');

    Route::get('/delete/{uuid}', "Resource\DeleteResourceController")->name('delete-resource');

});


Route::group(['prefix' => 'tag'], function () {
    Route::get('/{slug}', "Tag\HomeTagController")->name('home-tag');
});


Route::get('/social/redirect/{provider}', 'Auth\SocialController@getSocialRedirect')->name('social-redirect');
Route::get('/social/handle/{provider}', 'Auth\SocialController@getSocialHandle')->name('social-handle');