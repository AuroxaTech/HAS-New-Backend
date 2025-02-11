<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_status',
        'last_tenancy',
        'last_landlord_name',
        'last_landlord_contact',
        'occupation',
        'leased_duration',
        'no_of_occupants',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
