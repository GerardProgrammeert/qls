<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Clients;

use BeezMaster\QLSClient\Middleware\QLSRateLimiter;
use BeezMaster\QLSClient\Middleware\QLSRateLimiterMiddleware;
use BeezMaster\QLSClient\Middleware\ResponseLoggerMiddleware;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;

final readonly class ClientFactory extends AbstractClientFactory
{
    public function getStack(): HandlerStack
    {
        $stack = HandlerStack::create();

        $handler = new CurlHandler();
        $stack->setHandler($handler);

        $rateLimiter = new QLSRateLimiter($this->cacheKey);
        $rateLimiterMiddleware = app()->makeWith(QLSRateLimiterMiddleware::class, ['rateLimiter' => $rateLimiter]);
        $stack->push($rateLimiterMiddleware);

        if (config('qls-client.log_response')) {
            $responseLoggerMiddleware = new ResponseLoggerMiddleware();
            $stack->push($responseLoggerMiddleware);
        }
        return $stack;
    }
}
