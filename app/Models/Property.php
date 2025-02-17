<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'city', 'amount', 'address', 'lat', 'long', 
        'area_range', 'bedroom', 'bathroom', 'description', 
        'electricity_bill', 'property_type', 'property_sub_type', 'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propertyImages()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }
}
