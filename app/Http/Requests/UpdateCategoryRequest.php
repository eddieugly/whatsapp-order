<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['bail', 'required', 'string', 'max:50', Rule::unique(Category::class, 'name')->ignore($this->route('category'), 'ulid')],
            'slug' => ['bail', 'required', 'string', 'max:50', Rule::unique(Category::class, 'slug')->ignore($this->route('category'), 'ulid')],
            'description' => ['bail', 'sometimes', 'string', 'max:255'],
            'thumbnail' => ['bail', 'nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'status' => ['bail', 'sometimes', 'boolean'],
            'featured' => ['bail', 'sometimes', 'boolean'],
        ];
    }
}
