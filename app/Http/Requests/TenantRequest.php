<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
{
    public function authorize()
    {
        // If you want to allow all users, return true
        return true;
    }

    public function rules()
    {
        return [
            'last_status' => 'nullable|string|max:255',
            'last_tenancy' => 'nullable|string|max:255',
            'last_landlord_name' => 'nullable|string|max:255',
            'last_landlord_contact' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'leased_duration' => 'nullable|string|max:255',
            'no_of_occupants' => 'nullable|string|max:255',
        ];
    }
}
