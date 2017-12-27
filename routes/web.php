<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'resource'], function () {

    Route::get('/', "Resource\HomeResourceController")->name('home-resource');

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/create', "Resource\CreateResourceController")->name('create-resource');
        Route::post('/create', "Resource\StoreResourceController")->name('store-resource');

        Route::get('/edit/{uuid}', "Resource\EditResourceController")->name('edit-resource');
        Route::post('/edit/{uuid}', "Resource\UpdateResourceController")->name('update-resource');


        Route::group(['middleware' => 'is.admin'], function () {

            Route::get('/delete/{uuid}', "Resource\DeleteResourceController")->name('delete-resource');

            Route::get('/check/{uuid}', "Resource\CheckResourceController")->name('check-resource');

        });

    });

});

Route::group(['prefix' => 'tag'], function () {
    Route::get('/{slug}', "Tag\HomeTagController")->name('home-tag');
});


Route::get('/social/redirect/{provider}', 'Auth\SocialController@getSocialRedirect')->name('social-redirect');
Route::get('/social/handle/{provider}', 'Auth\SocialController@getSocialHandle')->name('social-handle');