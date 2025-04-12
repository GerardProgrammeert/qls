<?php

namespace BeezMaster\QLSClient;

use BeezMaster\QLSClient\Clients\ClientFactory;
use BeezMaster\QLSClient\Clients\ClientInterface;
use BeezMaster\QLSClient\Repositories\ProductsRepository;
use Illuminate\Support\ServiceProvider;

class QLSClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductsRepository::class, function () {
            $companyId = config('qls-client.company_id');
            $cacheKey = config('qls-client.cache_key');

            return new ProductsRepository($companyId, $cacheKey);
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
                //@todo create fake client
//                if ($this->app->environment('testing')) {
//                    return (new FakeClientFactory(...$args))->make();
//                }
                return (new ClientFactory(...$args))->make();
            });
    }
}
