<?php

namespace LemonSqueezy\PlainUiComponents;

use Illuminate\Support\ServiceProvider;

class PlainUiComponentsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/plain.php', 'plain');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/plain.php' => config_path('plain.php'),
            ]);
        }
    }
}
