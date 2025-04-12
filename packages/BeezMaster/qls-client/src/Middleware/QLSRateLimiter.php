<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Middleware;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;

final readonly class QLSRateLimiter implements RateLimiterServiceInterface
{
    public function __construct(
        protected string $cacheKey,
        private int $maxRateLimit = 500,
    ) {
        $this->initRateLimiter();
    }

    private function initRateLimiter(): void
    {
        if (!Cache::has($this->cacheKey)) {
            Cache::put($this->cacheKey, $this->maxRateLimit);
        }
    }

    public function canMakeRequest(): bool
    {
        return Cache::get($this->cacheKey) > 0;
    }

    public function updateRateLimits(ResponseInterface $response): void
    {
        $headers = $response->getHeaders();

        if (
            ($remainingCalls = $this->getRemainingFromHeaders($headers)) &&
            ($expiration = $this->getExpirationFromHeaders($headers))
        ) {
            $this->setRemainingCalls($remainingCalls, $expiration);
        }
    }

    private function getRemainingFromHeaders(array $headers): ?int
    {
        if (isset($headers['x-ratelimit-remaining'])) {
            return (int) $headers['x-ratelimit-remaining'][0];
        }

        return null;
    }

    private function getExpirationFromHeaders(array $headers): ?DateTimeInterface
    {
        if (isset($headers['x-ratelimit-reset'])) {
            return Carbon::createFromTimestamp((int) $headers['x-ratelimit-reset'][0], 'UTC');
        }

        return null;
    }

    public function setRemainingCalls(int $limit, DateTimeInterface $expirationDate): void
    {
        Cache::put($this->cacheKey, $limit, $expirationDate);
    }
}
