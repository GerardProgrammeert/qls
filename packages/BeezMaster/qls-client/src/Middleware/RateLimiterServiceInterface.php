<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Middleware;

use DateTimeInterface;
use Psr\Http\Message\ResponseInterface;

interface RateLimiterServiceInterface
{
    public function canMakeRequest(): bool;

    public function updateRateLimits(ResponseInterface $response): void;

    public function setRemainingCalls(int $limit, DateTimeInterface $expirationDate): void;
}
