<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255', Rule::unique(User::class, 'email')],
            'password' => ['bail', 'required', 'confirmed', Password::defaults()],
            'roleId' => ['bail', 'required', Rule::exists(Role::class, 'id')],
        ];
    }
}
