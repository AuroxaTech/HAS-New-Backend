<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyEmailController extends Controller
{
    public function verifyEmail($id)
    {
        
        $user = User::findOrFail($id);

        if ($user->is_verified==0) {
            $user->is_verified = true;
            $user->save();
            return view('emails.success');
        }
        return view('emails.verified');
    }
}
