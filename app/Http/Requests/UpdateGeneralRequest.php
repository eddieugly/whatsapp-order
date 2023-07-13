<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralRequest extends FormRequest
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
            'company_name' => ['bail', 'required', 'string', 'max:50'],
            'company_tagline' => ['bail', 'required', 'string', 'max:100'],
            'company_abbrevation' => ['bail', 'required', 'string', 'max:10'],
            'company_description' => ['bail', 'required', 'string', 'max:255'],
            'company_phone' => ['bail', 'required', 'string', 'max:50'],
            'company_email' => ['bail', 'required', 'email', 'max:50'],
            'company_address' => ['bail', 'required', 'string', 'max:100'],
            'company_seo_description' => ['bail', 'required', 'string', 'max:355'],
            'company_seo_keywords' => ['bail', 'required', 'array', 'max:355'],
            'company_logo_white' => [],
            'company_logo_dark' => [],
            'company_favicon' => [],
            'company_footer_text' => ['bail', 'required', 'string', 'max:100'],
            'facebook' => ['bail', 'required', 'string', 'max:50'],
            'twitter' => ['bail', 'required', 'string', 'max:50'],
            'instagram' => ['bail', 'required', 'string', 'max:50'],
        ];
    }
}
