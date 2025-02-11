<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function getLandlord($id)
    {

        $data = Property::where('user_id',$id)->with('user')->get();
        return view('partials.property.index', compact('data'));
    }
}
