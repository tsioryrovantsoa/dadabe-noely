<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterChildRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|unique:children,email',
            'password' => 'required|confirmed|min:8',
            'birth_year' => 'required|integer|between:'.(now()->year - 18).','.now()->year,
            'contact' => 'required|string|max:50',
        ];
    }

    /**
     * Get the custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'birth_year.between' => 'Tu dois avoir 18 ans au maximum pour écrire au Père Noël.',
        ];
    }
}
