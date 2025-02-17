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
            'role' => 'required|string|max:50|in:admin,user,tenant,service_provider,landlord',
            'phone_number' => 'required|string|max:15',
            'device_token' => 'required|string',
            'platform' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:25|regex:/^\d{1,25}$/',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'type' => 'required_if:role,landlord',
            'city' => 'required_if:role,landlord',
            'amount' => 'required_if:role,landlord',
            'address' => 'required_if:role,landlord',
            'lat' => 'required_if:role,landlord',
            'long' => 'required_if:role,landlord',
            'area_range' => 'required_if:role,landlord',
            'bedroom' => 'required_if:role,landlord',
            'bathroom' => 'required_if:role,landlord',
            'description' => 'required_if:role,landlord',
            'property_type' => 'required_if:role,landlord',
            'property_sub_type' => 'required_if:role,landlord',
            'electricity_bill' => 'required_if:role,landlord|image|mimes:jpg,jpeg,png|max:10240',
            'property_images' => 'required_if:role,landlord|array',
            'property_images.*' => 'image|mimes:jpg,jpeg,png|max:10240',

            'occupation' => 'required_if:role,tenant',
            'leased_duration' => 'required_if:role,tenant',
            'no_of_occupants' => 'required_if:role,tenant',

            'services' => 'required_if:role,service_provider|array',
            'year_experience' => 'required_if:role,service_provider',
            'pricing' => 'required_if:role,service_provider',
            'duration' => 'required_if:role,service_provider',
            'country' => 'required_if:role,service_provider',
            'location' => 'required_if:role,service_provider',
            'availability_start_time' => 'required_if:role,service_provider',
            'availability_end_time' => 'required_if:role,service_provider',
            'certification' => 'required_if:role,service_provider|image|mimes:jpg,jpeg,png|max:10240',
            'cnic_front' => 'required_if:role,service_provider|image|mimes:jpg,jpeg,png|max:10240',
            'cnic_back' => 'required_if:role,service_provider|image|mimes:jpg,jpeg,png|max:10240',
            
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
