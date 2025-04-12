<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Clients;

use GuzzleHttp\HandlerStack;

interface ClientFactoryInterface
{
    public function make(): ClientInterface;

    public function settings(): array;

    public function getHeaders(): array;

    public function getStack(): HandlerStack;
}
