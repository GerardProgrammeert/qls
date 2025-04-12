<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\Collection;

use Illuminate\Support\Collection;

abstract class AbstractCollection extends Collection
{
    /**@var $className class-string */
    protected string $className;

    /**
     *@param array<int, mixed> $items
     */
    public static function hydrate(array $items): static
    {
        $collection = new static();// @phpstan-ignore-line:

        foreach ($items as $item) {
            if ($collection->className::hydrate($item)) {
                $collection->add($collection->className::hydrate($item));
            }
        }

        return $collection;
    }
}
