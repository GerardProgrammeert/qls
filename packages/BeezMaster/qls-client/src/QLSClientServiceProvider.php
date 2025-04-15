<?php

namespace BeezMaster\QLSClient;

use BeezMaster\QLSClient\Clients\ClientFactory;
use BeezMaster\QLSClient\Clients\ClientInterface;
use BeezMaster\QLSClient\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class QLSClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductRepository::class, function () {
            $companyId = config('qls-client.company_id');
            $cacheKey = config('qls-client.cache_key');

            return new ProductRepository($companyId, $cacheKey);
        });
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

        app()->when(QLSService::class)
            ->needs(ClientInterface::class)
            ->give(function (): ClientInterface {
                $args = [
                    'baseUrl' => config('qls-client.base_url'),
                    'user' => config('qls-client.user'),
                    'pwd' =>  config('qls-client.pwd'),
                ];
                return (new ClientFactory(...$args))->make();
            });
    }
}
