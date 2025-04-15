<?php

namespace BeezMaster\QLSClient\Repositories;

use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function All(): ?Collection;

    public function refresh(): void;
}

