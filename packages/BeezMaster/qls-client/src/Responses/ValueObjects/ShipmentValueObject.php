<?php

declare(strict_types=1);

namespace BeezMaster\QLSClient\Responses\ValueObjects;

use BeezMaster\QLSClient\Enums\CustomsShipmentTypes;
use BeezMaster\QLSClient\Enums\ShipmentStatuses;
use BeezMaster\QLSClient\Enums\ShipmentTypes;
use BeezMaster\QLSClient\Responses\Collections\ShipmentProductsCollection;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use BeezMaster\QLSClient\ValueObjects\AbstractValueObject;

final readonly class ShipmentValueObject extends AbstractValueObject
{
    public function __construct (
        private string $id,
        private ?string $companyId,
        private ?string $brandId,
        private ?int $productId,
        private ?int $productCombinationId,
        private ?string $reference,
        private ?int $weight,
        private ?string $barcode,
        private ?string $trackingId,
        private ?string $trackingUrl,
        private ?float $codAmount,
        private ?string $labelPdfUrl,
        private ?string $labelZplUrl,
        private ?string $customsInvoiceNumber,
        private ?CustomsShipmentTypes $customsShipmentType,
        private ?ShipmentStatuses $status,
        private ?ShipmentTypes $type,
        private ?ContactValueObject $returnContact,
        private ContactValueObject $receiverContact,
        private ?ContactValueObject $deliveryContact,
        private ShipmentProductsCollection $shipmentProducts
    )
    {
    }

    /**
     * @param array<string, null|string> $data
     */
    public static function hydrate(array $data): self
    {
        $args = [
            'id' => self::parseAsString($data, 'id'),
            'companyId' =>  self::parseAsNullableString($data, 'company_id'),
            'brandId' => self::parseAsNullableString($data, 'brand_id'),
            'productId' => self::parseAsNullableInteger($data, 'product_id'),
            'productCombinationId' => self::parseAsNullableInteger($data, 'product_combination_id'),
            'reference' => self::parseAsNullableString($data, 'reference'),
            'weight' => self::parseAsNullableInteger($data, 'weight'),
            'barcode' => self::parseAsNullableString($data, 'barcode'),
            'trackingId' => self::parseAsNullableString($data, 'tracking_id'),
            'trackingUrl' => self::parseAsNullableString($data, 'tracking_url'),
            'codAmount' => self::parseAsNullableFloat($data, 'cod_amount'),
            'labelPdfUrl' => self::parseAsNullableString($data, 'label_pdf_url'),
            'labelZplUrl' => self::parseAsNullableString($data, 'label_zpl_url'),
            'customsInvoiceNumber' => self::parseAsNullableString($data, 'customs_invoice_number'),
            'customsShipmentType' => isset($data['customs_shipment_type']) ? CustomsShipmentTypes::tryFrom($data['customs_shipment_type']) : null,
            'status' => isset($data['status']) ? ShipmentStatuses::tryFrom($data['status']) : null,
            'type' => isset($data['type']) ? ShipmentTypes::tryFrom($data['type']) : null,
            'returnContact' =>  self::parseAsNullableContact($data, 'return_contact'),
            'receiverContact' => self::parseAsContact($data, 'receiver_contact'),
            'deliveryContact' => self::parseAsNullableContact($data, 'delivery_contact'),
            'shipmentProducts' => self::parseAsShipmentProducts($data, 'shipment_products'),
        ];

        return new self(...$args);
    }

    private static function parseAsNullableContact(array $data, string $key): ?ContactValueObject
    {
        if($contact = Arr::get($data, $key)) {
            return ContactValueObject::hydrate($contact);
        }

        return null;
    }

    private static function parseAsContact(array $data, string $key): ContactValueObject
    {
        if(!array_key_exists($key, $data)){
            throw new InvalidArgumentException("$key cannot be empty");
        }

        return ContactValueObject::hydrate($data[$key]);
    }

    private static function parseAsShipmentProducts(array $data, string $key): ShipmentProductsCollection
    {
        $collection = new ShipmentProductsCollection();
        if (!array_key_exists($key, $data)) {
            return $collection;
        }

        foreach($data[$key]['data'] as $item) {
            $collection->push(ShipmentProductValueObject::hydrate($item));
        }

        return $collection;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->companyId,
            'brand_id' => $this->brandId,
            'product_id' => $this->productId,
            'product_combination_id' => $this->productCombinationId,
            'reference' => $this->reference,
            'weight' => $this->weight,
            'barcode' => $this->barcode,
            'tracking_id' => $this->trackingId,
            'tracking_url' => $this->trackingUrl,
            'cod_amount' => $this->codAmount,
            'label_pdf_url' => $this->labelPdfUrl,
            'label_zpl_url' => $this->labelZplUrl,
            'customs_invoice_number' => $this->customsInvoiceNumber,
            'customs_shipment_type' => $this->customsShipmentType,
            'status' => $this->status,
            'type' => $this->type,
            'return_contact' => $this->returnContact?->toArray(),
            'receiver_contact' => $this->receiverContact->toArray(),
            'delivery_contact' => $this->deliveryContact?->toArray(),
            'shipment_products' => $this->shipmentProducts->isNotEmpty()
                ? ['data' => $this->shipmentProducts->toArray()]
                : null,
        ];
    }
}
