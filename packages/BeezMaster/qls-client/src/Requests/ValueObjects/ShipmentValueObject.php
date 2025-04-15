<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Requests\ValueObjects;

use BeezMaster\QLSClient\Enums\CustomsShipmentTypes;
use BeezMaster\QLSClient\Requests\Collections\ShipmentProductsCollection;
use BeezMaster\QLSClient\Responses\ValueObjects\ContactValueObject;
use BeezMaster\QLSClient\ValueObjects\AbstractValueObject;
use Illuminate\Support\Arr;
use InvalidArgumentException;

final readonly class ShipmentValueObject extends AbstractValueObject
{
    public function __construct(
        private int $productCombinationId,
        private string $brandId,
        private ?string $servicepointCode,
        private ?string $reference,
        private ?int $weight,
        private ?float $codAmount,
        private ?string $customsInvoiceNumber,
        private ?CustomsShipmentTypes $customsShipmentType,
        private ?ContactValueObject $returnContact,
        private ?ContactValueObject $senderContact,
        private ContactValueObject $receiverContact,
        private ShipmentProductsCollection $shipmentProducts,
        private bool $zplDirect
    )
    {
    }

    /**
     *@param array<string, mixed> $data
     */
    public static function hydrate(array $data): self
    {
        $args = [
            'productCombinationId' => self::parseAsInteger($data, 'product_combination_id'),
            'brandId' => self::parseAsString($data, 'brand_id'),
            'servicepointCode' => self::parseAsNullableString($data, 'servicepoint_code'),
            'reference' => self::parseAsNullableString($data, 'reference'),
            'weight' => self::parseAsNullableInteger($data, 'weight'),
            'codAmount' => self::parseAsNullableFloat($data, 'cod_amount'),
            'customsInvoiceNumber' => self::parseAsNullableString($data, 'customs_invoice_number'),
            'customsShipmentType' => self::parseAsEnum($data,'customs_shipment_type', CustomsShipmentTypes::class),
            'returnContact' =>  self::parseAsNullableContact($data, 'return_contact'),
            'senderContact' =>  self::parseAsNullableContact($data, 'sender_contact'),
            'receiverContact' => self::parseAsContact($data, 'receiver_contact'),
            'shipmentProducts' => self::parseAsShipmentProducts($data, 'shipment_products'),
            'zplDirect' => self::parseAsNullableBoolean($data, 'zpl_direct') ?? false,
        ];

        return new self(...$args);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'product_combination_id' => $this->productCombinationId,
            'brand_id' => $this->brandId,
            'servicepoint_code' => $this->servicepointCode,
            'reference' => $this->reference,
            'weight' => $this->weight,
            'cod_amount' => $this->codAmount,
            'customs_invoice_number' => $this->customsInvoiceNumber,
            'customs_shipment_type' => $this->customsShipmentType,
            'return_contact' => $this->returnContact?->toArray(),
            'sender_contact' => $this->senderContact?->toArray(),
            'receiver_contact' => $this->receiverContact->toArray(),
            'shipment_products' => $this->shipmentProducts->isNotEmpty()
                ? $this->shipmentProducts->toArray()
                : null,
            'zpl_direct' => $this->zplDirect,
        ];

        return array_filter($data);
    }

    /**
     *@param array<string, mixed> $data
     */
    private static function parseAsNullableContact(array $data, string $key): ?ContactValueObject
    {
        if($contact = Arr::get($data, $key)) {
            return ContactValueObject::hydrate($contact);
        }

        return null;
    }

    /**
     *@param array<string, mixed> $data
     */
    private static function parseAsContact(array $data, string $key): ContactValueObject
    {
        if(!array_key_exists($key, $data)){
            throw new InvalidArgumentException("$key cannot be empty");
        }

        return ContactValueObject::hydrate($data[$key]);
    }

    /**
     *@param array<string, mixed> $data
     */
    private static function parseAsShipmentProducts(array $data, string $key): ShipmentProductsCollection
    {
        $collection = new ShipmentProductsCollection();
        if (!array_key_exists($key, $data)) {
            return $collection;
        }

        foreach($data[$key] as $item) {
            $collection->push(ShipmentProductValueObject::hydrate($item));
        }

        return $collection;
    }
}
