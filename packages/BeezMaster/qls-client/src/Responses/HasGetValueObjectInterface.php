<?php

namespace BeezMaster\QLSClient\Responses;

use BeezMaster\QLSClient\ValueObjects\AbstractValueObject;

interface HasGetValueObjectInterface
{
    public function getValueObject(): AbstractValueObject;
}
