<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Middleware;

final readonly class QLSRateLimiterMiddleware extends AbstractRateLimiterMiddleware
{
    public function __construct(QLSRateLimiter $rateLimiter)
    {
        parent::__construct($rateLimiter);
    }
}
