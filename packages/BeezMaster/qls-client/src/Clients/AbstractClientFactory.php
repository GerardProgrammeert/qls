<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use InvalidArgumentException;

abstract readonly class AbstractClientFactory implements ClientFactoryInterface
{
    public function __construct(
        protected string $baseUrl,
        protected string $user,
        protected string $pwd,
        protected string $cacheKey = 'rate_limiter',
    ) {
    }

    public function make(): ClientInterface
    {
        $client = new Client($this->settings());

        return new GuzzleClient($client);
    }

    public function settings(): array
    {
        return [
            'base_uri' => $this->validateUrl($this->baseUrl),
            'headers'  => $this->getHeaders(),
            'handler'  => $this->getStack(),
        ];
    }

    public function getHeaders(): array
    {
        $credentials = base64_encode("$this->user:$this->pwd");

        return [
            'Authorization' => "Basic $credentials",
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ];
    }

    private function validateUrl(string $url): string
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("$url is not a valid URL");
        }

        return $url;
    }


    abstract public function getStack(): HandlerStack;
}
