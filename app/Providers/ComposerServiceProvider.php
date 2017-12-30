<?php

namespace Devoogle\Providers;

use Devoogle\Src\Devoogle\Composer\SidebarAuthorComposer;
use Devoogle\Src\Devoogle\Composer\SidebarCategoryComposer;
use Devoogle\Src\Devoogle\Composer\SidebarTagComposer;
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
        View::composer('sidebar/sidebar_category', SidebarCategoryComposer::class);

        View::composer('sidebar/sidebar_tag', SidebarTagComposer::class);

        View::composer('sidebar/sidebar_author', SidebarAuthorComposer::class);
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
