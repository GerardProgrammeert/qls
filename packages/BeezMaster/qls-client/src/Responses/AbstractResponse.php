<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses;

use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponse
{
    public int $statusCode;

    public readonly bool $hasError;

    public array $data;

    public readonly string $json;

    final public function __construct(ResponseInterface $response)
    {
        $this->json = $this->getResponseJson($response);
        $this->data = $this->parseJson($this->json);
        $this->statusCode = $this->getStatusCode($response);
        $this->hasError = $this->statusCode >= 400;
    }

    protected function getResponseJson(ResponseInterface $response): string
    {
        $body = $response->getBody();
        $body->rewind();

        return $body->getContents();
    }

    protected function getStatusCode(ResponseInterface $response): int
    {
        return $response->getStatusCode();
    }

    protected function parseJson(?string $json): array
    {
        if ($json === '' || $json === null || !Str::isJson($json)) {
            return [];
        }

        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return $data;
    }
}
