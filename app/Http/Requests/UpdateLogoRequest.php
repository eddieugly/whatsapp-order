<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLogoRequest extends FormRequest
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
            'company_logo_white' => ['bail', 'nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'],
            'company_logo_dark' => ['bail', 'nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'],
            'company_favicon' => ['bail', 'nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'],
        ];
    }
}
