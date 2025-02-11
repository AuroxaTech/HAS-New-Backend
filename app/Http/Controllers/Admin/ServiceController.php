<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
class ServiceController extends Controller
{
    public function getService($id)
    {

        $data = Service::where('user_id', $id)->with('user')->get();
        return view('partials.service.index', compact('data'));
    }
}
