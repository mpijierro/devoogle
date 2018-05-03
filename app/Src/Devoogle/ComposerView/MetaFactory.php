<?php

namespace Devoogle\Src\Devoogle\ComposerView;

use Devoogle\Src\Devoogle\Library\Route;

class MetaFactory
{

    private $pages;


    public function __construct()
    {
        $this->pages = [
            Route::ROUTE_NAME_HOME                => MetaHome::class,
            Route::ROUTE_NAME_CATEGORY_LIST       => MetaCategoryList::class,
            Route::ROUTE_NAME_TAG_LIST            => MetaTagList::class,
            Route::ROUTE_NAME_MOST_FAVOURITE_LIST => MetaMostFavouriteList::class
        ];

    }


    public function build()
    {

        if (isset($this->pages[\Illuminate\Support\Facades\Route::currentRouteName()])) {
            return app($this->pages[\Illuminate\Support\Facades\Route::currentRouteName()]);
        }

        return app(MetaHome::class);

    }

}