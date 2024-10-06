<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'card_number' => 'required|string|regex:/^(\d{4} ?){3}\d{4}$/', // Espacios opcionales entre grupos
            'expiry_date' => 'required|string|date_format:m/y|after:today',
            'cvv' => 'required|string|regex:/^\d{3}$/',
        ];
    }
}
