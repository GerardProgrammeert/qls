<?php

namespace BeezMaster\QLSClient\Responses;

use Illuminate\Support\Collection;

interface HasGetCollectionInterface
{
    public function getCollection(): Collection;
}
