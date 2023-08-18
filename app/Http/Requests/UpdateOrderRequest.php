<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('manage order');
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
            'order_status' => ['bail', 'required', 'integer', Rule::in(0, 1, 2, 3)],
        ];
    }
}
