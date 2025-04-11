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
        if (!file_exists(config_path('qls-client.php'))) {
            $this->publishes([
                __DIR__ . '/config/qls-client.php' => config_path('qls-client.php'),
            ], 'config');

            $this->mergeConfigFrom(
                __DIR__ . '/config/qls-client.php', 'qls-client'
            );
        }
    }
}
