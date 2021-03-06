<?php

Route::get('/', "Resource\HomeResourceController")->name('home');

Route::get('/social/redirect/{provider}', 'Auth\SocialController@getSocialRedirect')->name('social-redirect');
Route::get('/social/handle/{provider}', 'Auth\SocialController@getSocialHandle')->name('social-handle');

Auth::routes();

Route::get('/buscar', "Resource\SearchResourceController")->name('search-resource-get');
Route::post('/buscar', "Resource\SearchResourceController")->name('search-resource');

Route::group(['prefix' => \Devoogle\Src\Devoogle\Library\Route::PREFIX_URL_TAG_LIST], function () {
    Route::get('/{slug}', "Tag\TagListController")->name(\Devoogle\Src\Devoogle\Library\Route::ROUTE_NAME_TAG_LIST);
});

Route::group(['prefix' => \Devoogle\Src\Devoogle\Library\Route::PREFIX_URL_CATEGORY_LIST], function () {
    Route::get('/{slug}', "Category\CategoryListController")->name(\Devoogle\Src\Devoogle\Library\Route::ROUTE_NAME_CATEGORY_LIST);
});

Route::group(['prefix' => \Devoogle\Src\Devoogle\Library\Route::PREFIX_URL_MOST_FAVOURITE], function () {
    Route::get('/', "Favourite\MostFavouriteListController")->name(\Devoogle\Src\Devoogle\Library\Route::ROUTE_NAME_MOST_FAVOURITE_LIST);
});

Route::group(['prefix' => \Devoogle\Src\Devoogle\Library\Route::PREFIX_DOWNLOAD_AUDIO], function () {
    Route::get('/{slug}', "Resource\DownloadResourceController")->name(\Devoogle\Src\Devoogle\Library\Route::ROUTE_NAME_DOWNLOAD_AUDIO);
    Route::post('/{slug}', "Resource\SendDownloadResourceController")->name(\Devoogle\Src\Devoogle\Library\Route::ROUTE_NAME_SEND_DOWNLOAD_AUDIO );
});

Route::group(['prefix' => 'input'], function () {
    Route::get('/tag/{type}', "Tag\SearchTagController")->name('input-tag');
});

Route::get('/aviso-legal', "Legal\LegalController")->name('legal');
Route::get('/gracias-a', "Legal\ThanksController")->name('thanks');
Route::get('/contacto', "Legal\ContactController")->name('contact');

Route::group(['prefix' => 'recursos', 'middleware' => 'auth'], function () {

    Route::get('/crear', "Resource\CreateResourceController")->name('create-resource');
    Route::post('/crear', "Resource\StoreResourceController")->name('store-resource');

    Route::get('/crear-version/{uuid}', "Version\CreateVersionController")->name('create-version');
    Route::post('/crear-version/{uuid}', "Version\StoreVersionController")->name('store-version');

    Route::get('/editar/{uuid}', "Resource\EditResourceController")->name('edit-resource')->middleware(['is.resource.owner', 'is.not.reviewed']);
    Route::post('/editar/{uuid}', "Resource\UpdateResourceController")->name('update-resource')->middleware(['is.resource.owner', 'is.not.reviewed']);
    Route::get('/eliminar/{uuid}', "Resource\DeleteResourceController")->name('delete-resource')->middleware(['is.resource.owner', 'is.not.reviewed']);

    Route::get('/editar-version/{uuid}', "Version\EditVersionController")->name('edit-version')->middleware(['is.version.owner', 'is.not.reviewed']);
    Route::post('/editar-version/{uuid}', "Version\UpdateVersionController")->name('update-version')->middleware(['is.version.owner', 'is.not.reviewed']);
    Route::get('/eliminar-version/{uuid}', "Version\DeleteVersionController")->name('delete-version')->middleware(['is.version.owner', 'is.not.reviewed']);

    Route::get('/favorito/{uuid}', "Favourite\ToggleFavouriteController")->name('toggle-favourite');
    Route::get('/favoritos', "Favourite\UserListFavouriteController")->name('user-list-favourite');

    Route::get('/para-despues/{uuid}', "Later\ToggleLaterController")->name('toggle-later');
    Route::get('/para-despues', "Later\UserListLaterController")->name('user-list-later');

    Route::get('/marcar-como-visto/{uuid}', "Viewed\ToggleViewedController")->name('toggle-viewed');
    Route::get('/recursos-vistos', "Viewed\UserListViewedController")->name('user-list-viewed');

    Route::get('/mis-recursos', "Profile\UserListAddedController")->name('my-resources');

    Route::group(['middleware' => 'is.admin'], function () {


        Route::get('/revisar-recurso/{uuid}', "Resource\CheckResourceController")->name('check-resource');

        Route::get('/revisar-version/{uuid}', "Version\CheckVersionController")->name('check-version');

        Route::get('/destruir/{uuid}', "Resource\DestroyResourceController")->name('destroy-resource');


    });

});

