<?php

namespace App\Http\Requests;

use App\Models\Blogcategory;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogcategoryRequest extends FormRequest
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
            'name' => ['bail', 'required', 'string', 'max:50', Rule::unique(Blogcategory::class, 'name')->ignore($this->route('blog_category'), 'ulid')],
            'slug' => ['bail', 'required', 'string', 'max:50', Rule::unique(Blogcategory::class, 'slug')->ignore($this->route('blog_category'), 'ulid')],
            'description' => ['bail', 'sometimes', 'string', 'max:255'],
            'thumbnail' => ['bail', 'nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'status' => ['bail', 'sometimes', 'boolean'],
            'featured' => ['bail', 'sometimes', 'boolean'],
        ];
    }
}
