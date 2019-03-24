<?php

namespace Devoogle\Src\Search;


use Devoogle\Src\Search\Library\EloquentSearchMachine;
use Devoogle\Src\Search\Library\SearchMachineInterface;
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
        $this->app->bind(SearchMachineInterface::class,EloquentSearchMachine::class);
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
