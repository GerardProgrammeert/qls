<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'billing.company_name' => ['nullable', 'string'],
            'billing.name' => ['required', 'string'],
            'billing.street' => ['required', 'string'],
            'billing.house_number' => ['required', 'string'],
            'billing.address_line_2' => ['nullable', 'string'],
            'billing.zipcode' => ['required', 'string'],
            'billing.city' => ['required', 'string'],
            'billing.email' => ['nullable', 'email'],
            'billing.phone' => ['nullable', 'string'],

            'delivery.company_name' => ['nullable', 'string'],
            'delivery.name' => ['required', 'string'],
            'delivery.street' => ['required', 'string'],
            'delivery.house_number' => ['required', 'string'],
            'delivery.address_line_2' => ['nullable', 'string'],
            'delivery.zipcode' => ['required', 'string'],
            'delivery.city' => ['required', 'string'],
            'delivery.email' => ['nullable', 'email'],
            'delivery.phone' => ['nullable', 'string'],
        ];
    }
}
