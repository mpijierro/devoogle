<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'recursos'], function () {

    Route::get('/', "Resource\HomeResourceController")->name('home-resource');

    Route::get('/buscar', "Resource\SearchResourceController")->name('search-resource-get');
    Route::post('/buscar', "Resource\SearchResourceController")->name('search-resource');

    Route::group(['prefix' => 'recursos-de-programacion-de'], function () {
        Route::get('/{slug}', "Tag\TagListController")->name('list-tag');
    });

    Route::group(['prefix' => 'recursos-de-desarrollo-de-software-en'], function () {
        Route::get('/{slug}', "Category\CategoryListController")->name('list-category');
    });

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/crear', "Resource\CreateResourceController")->name('create-resource');
        Route::post('/crear', "Resource\StoreResourceController")->name('store-resource');

        Route::get('/editar/{uuid}', "Resource\EditResourceController")->name('edit-resource');
        Route::post('/editar/{uuid}', "Resource\UpdateResourceController")->name('update-resource');

        Route::get('/crear-version/{uuid}', "Version\CreateVersionController")->name('create-version');
        Route::post('/crear-version/{uuid}', "Version\StoreVersionController")->name('store-version');
        Route::get('/editar-version/{uuid}', "Version\EditVersionController")->name('edit-version');
        Route::post('/editar-version/{uuid}', "Version\UpdateVersionController")->name('update-version');


        Route::group(['middleware' => 'is.admin'], function () {

            Route::get('/eliminar-recurso/{uuid}', "Resource\DeleteResourceController")->name('delete-resource');
            Route::get('/revisar-recurso/{uuid}', "Resource\CheckResourceController")->name('check-resource');

        });

    });

});


Route::get('/social/redirect/{provider}', 'Auth\SocialController@getSocialRedirect')->name('social-redirect');
Route::get('/social/handle/{provider}', 'Auth\SocialController@getSocialHandle')->name('social-handle');