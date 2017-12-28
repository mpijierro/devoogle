<?php

namespace Devoogle\Src\Resource;

use Illuminate\Support\ServiceProvider;
use Devoogle\Src\Resource\Model\Resource;

use Illuminate\Database\Eloquent\Relations\Relation;

class ResourceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'resource' => Resource::class,
        ]);
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
