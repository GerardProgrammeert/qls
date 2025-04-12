<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

abstract readonly class AbstractRateLimiterMiddleware
{
    public function __construct(private RateLimiterServiceInterface $rateLimiter)
    {
    }

    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            if (!$this->rateLimiter->canMakeRequest()) {
                throw new RuntimeException('Rate limit exceeded for ' . $request->getUri()->getHost());
            }

            return $handler($request, $options)->then(
                function (ResponseInterface $response) {
                    $this->rateLimiter->updateRateLimits($response);
                    return $response;
                }
            );
        };
    }
}
