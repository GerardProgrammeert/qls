<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;
use InvalidArgumentException;

abstract readonly class AbstractValueObject implements Arrayable
{
    abstract public static function hydrate(array $data): self;

    /**
     *@param array<string, mixed> $data
     */
    protected static function parseAsString(array $data, string $key): string
    {
        if (!array_key_exists($key, $data) || !is_string($data[$key])) {
            throw new InvalidArgumentException("$key must be a string and cannot be empty");
        }

        return $data[$key];
    }

    /**
     *@param array<string, mixed> $data
     */
    protected static function parseAsInteger(array $data, string $key): int
    {
        if(!array_key_exists($key, $data) || !is_integer($data[$key])){
            throw new InvalidArgumentException("$key must be a integer and cannot be empty");
        }

        return $data[$key];
    }

    /**
     *@param array<string, mixed> $data
     */
    protected static function parseAsFloat(array $data, string $key): float
    {
        if(!array_key_exists($key, $data) || !is_float((float)$data[$key])){
            throw new InvalidArgumentException("$key must be a float and cannot be empty");
        }

        return (float)$data[$key];
    }


    /**
     *@param array<string, mixed> $data
     */
    protected static function parseAsBoolean(array $data, string $key): bool
    {
        if (!array_key_exists($key, $data) || !is_bool($data[$key])) {
            throw new InvalidArgumentException("$key must be a bool and cannot be empty");
        }

        return $data[$key];
    }

    /**
     *@param array<string, mixed> $data
     */
    protected static function parseAsNullableString(array $data, string $key): ?string
    {
        return isset($data[$key]) ? (string)$data[$key] : null;
    }

    /**
     *@param array<string, mixed> $data
     */
    protected static function parseAsNullableInteger(array $data, string $key): ?int
    {
        return isset($data[$key]) ? (int)$data[$key] : null;
    }

    /**
     *@param array<string, mixed> $data
     */
    protected static function parseAsNullableFloat(array $data, string $key): ?float
    {
        return isset($data[$key]) ? (float)$data[$key] : null;
    }
}
