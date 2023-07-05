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
            'name' => ['bail', 'required', 'string', 'max:50', Rule::unique(Menu::class, 'name')],
            'slug' => ['bail', 'required', 'string', 'max:50', Rule::unique(Menu::class, 'slug')],
            'description' => ['bail', 'sometimes', 'string', 'max:255'],
            'price' => ['bail', 'required', 'integer', 'gt:0'],
            'status' => ['bail', 'sometimes', 'boolean'],
            'featured' => ['bail', 'sometimes', 'boolean'],
            'slider' => ['bail', 'sometimes', 'boolean'],
            'thumbnail' => ['bail', 'nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
        ];
    }
}
