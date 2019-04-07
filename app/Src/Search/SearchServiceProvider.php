<?php

namespace Devoogle\Src\Search;


use Devoogle\Src\Search\Library\EloquentSearchMachine;
use Devoogle\Src\Search\Library\SearchMachineInterface;
use Devoogle\Src\Search\Library\Sphinx\ExcerptsOptions;
use Devoogle\Src\Search\Library\Sphinx\ExcerptsOptionsInterface;
use Devoogle\Src\Search\Library\Sphinx\SphinxOptions;
use Devoogle\Src\Search\Library\Sphinx\SphinxOptionsInterface;
use Devoogle\Src\Search\Library\SphinxSearchMachine;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SearchMachineInterface::class,SphinxSearchMachine::class);
        $this->app->bind(ExcerptsOptionsInterface::class,ExcerptsOptions::class);
        $this->app->bind(SphinxOptionsInterface::class,SphinxOptions::class);
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
