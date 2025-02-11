<?php

namespace App\Repositories;

use App\Interfaces\ServiceFavouriteRepositoryInterface;
use App\Models\Favourite;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceFavouriteRepository implements ServiceFavouriteRepositoryInterface
{

    public function all()
    {
        return Favourite::where('user_id', Auth::id())
            ->where('favouritable_type', Service::class)
            ->with('favouritable') // Eager load the property details
            ->get();
    }
    public function addFavourite(array $data)
    {
        $userId = Auth::id();
        return Favourite::create([
            'user_id' => $userId,
            'favouritable_id' => $data['service_id'],
            'favouritable_type' => Service::class,
            'fav_flag' => $data['fav_flag'] ?? 1,
        ]);
    }

    public function removeFavourite($id)
    {
        $favourite = Favourite::findOrFail($id);
        $favourite->delete();
        return $favourite;
    }
}
