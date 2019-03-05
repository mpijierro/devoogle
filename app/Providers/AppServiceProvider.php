<?php

namespace Devoogle\Providers;

use Devoogle\Src\Resource\Library\AudioFile;
use Devoogle\Src\Resource\Library\AudioFileInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AudioFileInterface::class, AudioFile::class);
    }
}
