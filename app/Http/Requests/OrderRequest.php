<?php

namespace App\Http\Requests;

use App\Enums\ContactTypeEnum;
use App\Rules\PostalCodeRule;
use App\Rules\ProductCombinationRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     *@return array<string, string>
     */
    public function rules(): array
    {
        return [
            'order_id' => ['nullable','int', 'exists:orders,id'],
            'shipment_products' => 'required|array',
            'shipment_products.*.amount' => ['required', 'integer', 'min:1'],
            'shipment_products.*.price_per_unit' => ['required', 'numeric'],
            'shipment_products.*.name' => ['required', 'string'],
            'receiver_contact.type' => ['required', 'string', 'in:' . implode(',', ContactTypeEnum::values())],
            'receiver_contact.companyname' => ['nullable', 'string'],
            'receiver_contact.name' => ['required', 'string'],
            'receiver_contact.street' => ['required', 'string'],
            'receiver_contact.housenumber' => ['required', 'int'],
            'receiver_contact.address2' => ['nullable', 'string'],
            'receiver_contact.postalcode' => ['required', 'string', new PostalCodeRule()],
            'receiver_contact.locality' => ['required', 'string'],
            'receiver_contact.country' => ['required', 'string'],
            'receiver_contact.email' => ['nullable', 'email'],
            'receiver_contact.phone' => ['nullable', 'string'],
            'is-same' => ['nullable', 'in:true,false'],
            'delivery.companyname' => ['nullable', 'string'],
            'delivery.name' => ['required_if:is-same,false', 'string'],
            'delivery.street' => ['required_if:is-same,false', 'string'],
            'delivery.housenumber' => ['required_if:is-same,false', 'string'],
            'delivery.address2' => ['nullable', 'string'],
            'delivery.postalcode' => ['required_if:is-same,false', 'string', new PostalCodeRule()],
            'delivery.locality' => ['required_if:is-same,false', 'string'],
            'delivery.email' => ['nullable', 'email'],
            'delivery.phone' => ['nullable', 'string'],
            'product_combination_id' => ['required', 'integer', new ProductCombinationRule()],
            'brand_id' => ['required', 'string'],
        ];
    }

    public function prepareForValidation(): void
    {
        $products = collect(data_get($this->all(), 'shipment_products'))->map(function ($product) {
            return [
                'amount' => (int) $product['amount'],
                'price_per_unit' => (float) $product['price_per_unit'],
                'name' => $product['name'],
            ];
        })->toArray();

        $this->merge([
            'product_combination_id' => (int)$this->input('product_combination_id'),
            'shipment_products' => $products,
            'brand_id' => config('qls-client.brand_id'),
            'receiver_contact' => array_merge(data_get($this->all(), 'receiver_contact'), ['country' => 'NL']),
        ]);
    }
}
