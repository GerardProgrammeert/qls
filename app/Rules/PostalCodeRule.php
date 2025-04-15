<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PostalCodeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValidDutchPostcode($value)) {
            $fail('Invalid Postalcode provided, format 1234 AB');
        }
    }

    private function isValidDutchPostcode(string $postcode): bool
    {
        return preg_match('/^[1-9][0-9]{3}\s?[A-Z]{2}$/', strtoupper($postcode)) === 1;
    }
}
