<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Models\User;

class ApproveUserController extends Controller
{
    use ResponseTrait;
    public function approveUser($id)
    {
        
        $user = User::findOrFail($id);

            $user->approved_at = true;
            $user->save();
            return back();
    }
}
