<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50', Rule::unique(Menu::class, 'name')],
            'description' => ['sometimes', 'string', 'max:255'],
            'status' => ['required', 'numeric', 'in:0,1'],
            'price' => ['required', 'numeric', 'gt:0'],
            'thumbnail' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
        ];
    }
}
