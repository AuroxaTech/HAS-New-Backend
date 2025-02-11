<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|max:50',
            'phone_number' => 'required|string|max:15',
            'device_token' => 'required|string',
            'platform' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:25|regex:/^\d{1,25}$/',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'The email has already been taken.',
            'user_name.unique' => 'The username has already been taken.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
