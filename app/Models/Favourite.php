<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'favouritable_id',
        'favouritable_type',
        'fav_flag',
    ];

    // Polymorphic relationship
    public function favouritable()
    {
        return $this->morphTo();
    }
}
