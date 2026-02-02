<?php

namespace Ghanem\RemoteImage;

use Illuminate\Support\ServiceProvider;

class RemoteImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/remote-image.php',
            'remote-image'
        );

        $this->app->singleton('remote-image', function ($app) {
            return new RemoteImageService();
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/remote-image.php' => config_path('remote-image.php'),
            ], 'config');
        }
    }
}
