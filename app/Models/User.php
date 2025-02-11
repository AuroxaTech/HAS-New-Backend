<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The primary key for the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'user_name',
        'phone_number',
        'password',
        'role',
        'profile_image',
        'status',
        'created_by',
        'platform',
        'device_token',
        'address',
        'postal_code',
        'is_verified',
        'verification_token',

    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
