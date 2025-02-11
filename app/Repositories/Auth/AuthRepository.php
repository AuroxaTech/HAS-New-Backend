<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Interfaces\Auth\AuthRepositoryInterface;
use App\Helpers\ImageUpload;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use App\Mail\VerifyEmail;

class AuthRepository implements AuthRepositoryInterface
{
    use ImageUpload;

    public function create(array $data)
    {
        $userData = [
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
            'platform' => $data['platform'],
            'device_token' => $data['device_token'],
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
        ];

        if (isset($data['profile_image'])) {
            $image = $this->uploadImage($data['profile_image'], 'profile_images');
            $userData['profile_image'] = $image['url'];
        }
        $user = User::create($userData);
        Mail::to($user->email)->send(new VerifyEmail($user));
        return $user;
    }

    public function login(array $data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['user'] = $user;
            return response()->json($success, 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function updateProfile(array $data)
    {
        $userId=Auth::id();
        $user = User::find($userId);
        $userData = [
            'full_name' => $data['full_name'] ?? $user->full_name,
            'email' => $data['email'] ?? $user->email,
            'user_name' => $data['user_name'] ?? $user->user_name,
            'phone_number' => $data['phone_number'] ?? $user->phone_number,
            'address' => $data['address'] ?? $user->address,
            'postal_code' => $data['postal_code'] ?? $user->postal_code,
        ];

        if (isset($data['profile_image'])) {
            if ($user->profile_image) {
                $existingImagePath = str_replace('/storage/', '', $user->profile_image);
                $this->deleteImage($existingImagePath);
            }
            $image = $this->uploadImage($data['profile_image'], 'profile_images');
            $userData['profile_image'] = $image['url'];
        }
        $user->update($userData);

        return $user;
    }

    public function updatePassword(array $data)
    {
        $userId=Auth::id();
        $user = User::find($userId);
        if (!Hash::check($data['current_password'], $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }
        $user->password = Hash::make($data['new_password']);
        $user->save();

        return $user;
    }

}
