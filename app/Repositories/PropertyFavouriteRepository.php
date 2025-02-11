<?php

namespace App\Repositories;

use App\Interfaces\PropertyFavouriteRepositoryInterface;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;

class PropertyFavouriteRepository implements PropertyFavouriteRepositoryInterface
{

    public function all()
    {
        return Favourite::where('user_id', Auth::id())
            ->where('favouritable_type', Property::class)
            ->with('favouritable') // Eager load the property details
            ->get();
    }
    public function addFavourite(array $data)
    {

        $userId = Auth::id();
        return Favourite::create([
            'user_id' => $userId,
            'favouritable_id' => $data['property_id'],
            'favouritable_type' => Property::class,
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
