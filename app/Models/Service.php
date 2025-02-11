<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_name',
        'description',
        'pricing',
        'duration',
        'start_time',
        'end_time',
        'location',
        'lat',
        'long',
        'additional_information',
        'country',
        'city',
        'year_experience',
        'cnic_front_pic',
        'cnic_back_pic',
        'certification',
        'resume'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function serviceImages()
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
