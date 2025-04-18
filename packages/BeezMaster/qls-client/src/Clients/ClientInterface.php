<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Clients;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function get(string $url, array $options = []): ResponseInterface;
    public function post(string $url, array $options = []): ResponseInterface;
    public function put(string $url, array $options = []): ResponseInterface;
    public function patch(string $url, array $options = []): ResponseInterface;
    public function delete(string $url): ResponseInterface;
}
