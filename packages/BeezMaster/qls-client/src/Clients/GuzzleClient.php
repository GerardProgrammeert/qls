<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Clients;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class GuzzleClient implements ClientInterface
{
    public function __construct(public Client $client)
    {
    }

    public function get(string $url, array $options = []): ResponseInterface
    {
        return $this->client->get($url, $options);
    }

    public function post(string $url, array $options = []): ResponseInterface
    {
        return $this->client->post($url, $options);
    }

    public function put(string $url, array $options = []): ResponseInterface
    {
        return $this->client->put($url, $options);
    }

    public function patch(string $url, array $options = []): ResponseInterface
    {
        return $this->client->patch($url, $options);
    }

    public function delete(string $url): ResponseInterface
    {
        return $this->client->delete($url);
    }
}
