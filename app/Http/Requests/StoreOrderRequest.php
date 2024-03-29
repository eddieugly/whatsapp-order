<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => ['bail', 'required', 'string', 'max:50'],
            'customer_email' => ['bail', 'required', 'string', 'max:50'],
            'customer_phone' => ['bail', 'required', 'string', 'max:50'],
            'amount' => ['bail', 'required', 'numeric', 'gt:0'],
            'tx_ref' => ['bail', 'sometimes', 'nullable', 'string', 'max:50'],
            'payment_method' => ['bail', 'required', 'integer', Rule::in(0, 1)],
            'cart' => ['bail', 'required', 'array'],
            'cart.*.id' => [Rule::exists(Menu::class, 'ulid')],
            'cart.*.name' => [Rule::exists(Menu::class, 'name')],
            'cart.*.quantity' => ['bail', 'required', 'integer', 'gte:1'],
            'cart.*.price' => ['bail', 'required', 'numeric', 'gte:0'],
        ];
    }
}
