<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize()
    {
        // Authorization logic. Set this to true if you don't need authorization checks.
        return true;
    }

    public function rules()
    {
        return [
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pricing' => 'required|numeric',
            'duration' => 'required|integer',
            'start_time' => 'nullable|date_format:h:i A',
            'end_time' => 'nullable|date_format:h:i A',
            'location' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'additional_information' => 'nullable|string',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'year_experience' => 'nullable|integer',
            'cnic_front_pic' => 'nullable',
            'cnic_back_pic' => 'nullable',
            'certification' => 'nullable',
            'resume' => 'nullable',
            'service_images.*' => 'image',
        ];
    }
}
