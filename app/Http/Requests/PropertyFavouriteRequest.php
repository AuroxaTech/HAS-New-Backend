<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFavouriteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'property_id' => 'required|integer|exists:properties,id',
            'fav_flag' => 'nullable|integer',
        ];
    }
}
