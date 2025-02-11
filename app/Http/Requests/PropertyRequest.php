<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Set to true if you don't want authorization logic.
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string',
            'city' => 'required|string',
            'amount' => 'required|numeric',
            'address' => 'required|string',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'area_range' => 'required|string',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'description' => 'required|string',
            'electricity_bill_image' => 'required',
            'property_type' => 'required|string',
            'property_sub_type' => 'required|string',
            'property_images.*' => 'image',
        ];
    }
}
