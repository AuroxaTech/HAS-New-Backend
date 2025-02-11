<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\User;
class TenantController extends Controller
{
    public function getTenant($id)
    {

        $data = Tenant::where('user_id', $id)->with('user')->get();
        return view('partials.tenant.index', compact('data'));
    }
}
