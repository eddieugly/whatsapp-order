<?php

namespace App\Http\Requests;

use App\Models\Blog;
use App\Models\Blogcategory;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'blogcategory_id' => ['bail', 'required', Rule::exists(Blogcategory::class, 'ulid')],
            'title' => ['bail', 'required', 'string', 'max:555', Rule::unique(Blog::class, 'title')],
            'slug' => ['bail', 'required', 'string', 'max:559', Rule::unique(Blog::class, 'slug')],
            'description' => ['bail', 'required', 'string'],
            'status' => ['bail', 'sometimes', 'boolean'],
            'featured' => ['bail', 'sometimes', 'boolean'],
            'slider' => ['bail', 'sometimes', 'boolean'],
            'thumbnail' => ['bail', 'nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
        ];
    }
}
