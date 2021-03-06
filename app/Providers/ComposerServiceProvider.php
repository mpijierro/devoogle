<?php

namespace Devoogle\Providers;

use Devoogle\Src\Devoogle\ComposerView\AudioFileComposer;
use Devoogle\Src\Devoogle\ComposerView\MetasComposer;
use Devoogle\Src\Devoogle\ComposerView\SidebarAuthorComposer;
use Devoogle\Src\Devoogle\ComposerView\SidebarCategoryComposer;
use Devoogle\Src\Devoogle\ComposerView\SidebarEventComposer;
use Devoogle\Src\Devoogle\ComposerView\SidebarTagComposer;
use Devoogle\Src\Devoogle\ComposerView\SidebarTechnologyComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('layouts/metas', MetasComposer::class);

        View::composer('layouts/app', SidebarCategoryComposer::class);

        View::composer('sidebar/sidebar_category', SidebarCategoryComposer::class);

        View::composer('sidebar/sidebar_tag', SidebarTagComposer::class);

        View::composer('sidebar/sidebar_author', SidebarAuthorComposer::class);

        View::composer('sidebar/sidebar_event', SidebarEventComposer::class);

        View::composer('sidebar/sidebar_technology', SidebarTechnologyComposer::class);

        View::composer('resource/resource_register',AudioFileComposer::class);


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
