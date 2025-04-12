<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\ValueObjects;

final readonly class ContactValueObject extends AbstractValueObject
{
    public function __construct (
        private string $name,
        private string $companyName,
        private string $street,
        private string $houseNumber,
        private ?string $address2,
        private string $postalcode,
        private string $locality,
        private string $country,
        private ?string $email,
        private ?string $phone,
        private ?string $vat,
        private ?string $eori,
        private ?string $oss
    )
    {
    }

    /**
     * @param array<string, null|string> $data
     */
    public static function hydrate(array $data): self
    {
        $args = [
            'name' => self::parseAsString($data, 'name'),
            'companyName' => self::parseAsString($data, 'companyname'),
            'street' =>  self::parseAsString($data, 'street'),
            'houseNumber' => self::parseAsString($data, 'housenumber'),
            'address2' => self::parseAsNullableString($data, 'address2'),
            'postalcode' => self::parseAsString($data, 'postalcode'),
            'locality' =>  self::parseAsString($data,'locality'),
            'country' => self::parseAsString($data,'country'),
            'email' => self::parseAsNullableString($data, 'email'),
            'phone' => self::parseAsNullableString($data,'phone'),
            'vat' => self::parseAsNullableString($data,'vat'),
            'eori' => self::parseAsNullableString($data,'eori'),
            'oss' => self::parseAsNullableString($data,'oss'),
        ];

        return new self(...$args);
    }

    /**
     * @return array<string, null|string>
     */
    public function toArray(): array
    {
        return [
            'name'=> $this->name,
            'companyname'=> $this->companyName,
            'street'=> $this->street,
            'housenumber'=> $this->houseNumber,
            'address2'=> $this->address2,
            'postalcode'=> $this->postalcode,
            'locality'=> $this->locality,
            'country'=> $this->country,
            'email'=> $this->email,
            'phone'=> $this->phone,
            'vat'=> $this->vat,
            'eori'=> $this->eori,
            'oss'=> $this->oss,
        ];
    }
}
