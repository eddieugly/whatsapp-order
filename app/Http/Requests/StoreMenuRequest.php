<?php

namespace App\Http\Requests;

use App\Models\Menu;
use App\Models\Extra;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'category_id' => ['bail', 'required', Rule::exists(Category::class, 'ulid')],
            'name' => ['bail', 'required', 'string', 'max:50', Rule::unique(Menu::class, 'name')],
            'slug' => ['bail', 'required', 'string', 'max:50', Rule::unique(Menu::class, 'slug')],
            'description' => ['bail', 'sometimes', 'string'],
            'price' => ['bail', 'required', 'integer', 'gt:0'],
            'status' => ['bail', 'sometimes', 'boolean'],
            'featured' => ['bail', 'sometimes', 'boolean'],
            'slider' => ['bail', 'sometimes', 'boolean'],
            'has_extras' => ['bail', 'sometimes', 'boolean'],
            'thumbnail' => ['bail', 'nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'extras' => ['bail', 'required_if:has_extras,1', 'array'],
            'extras.*' => [Rule::exists(Extra::class, 'ulid')],
        ];
    }
}
