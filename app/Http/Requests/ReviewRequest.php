<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'service_id' => 'required|exists:services,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ];
    }


}

