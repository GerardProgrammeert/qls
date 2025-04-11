<?php

namespace BeezMaster\QLSClient;

use Illuminate\Support\ServiceProvider;

class QLSClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register bindings, singletons, or configs here
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/qls-client.php' => config_path('qls-client.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/config/qls-client.php', 'qls-client'
        );
    }
}
