<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Models\Property;
use App\Models\Tenant;
use App\Interfaces\Auth\AuthRepositoryInterface;
use App\Helpers\ImageUpload;
use App\Helpers\UserRegistration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use App\Models\Service;
use Exception;
use Auth;
use Illuminate\Support\Facades\Storage;
use Mail;

class AuthRepository implements AuthRepositoryInterface
{
    use ImageUpload, UserRegistration;

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
            'verification_token' => Str::random(64)
        ];

        if (isset($data['profile_image'])) {
            $image = $this->uploadImage($data['profile_image'], 'profile_images');
            $userData['profile_image'] = $image['url'];
        }

        $user = User::create($userData);

        // TODO: save roles to constants
        // TODO: save messages to constants files
        if ($data['role'] == 'landlord') {
            $billImage = $this->saveBill($data);
            $propertyImages = $this->savePropertyImages($data);
            $data['user_id'] = $user->id;
            $data['images'] = $propertyImages;
            $data['electricity_bill'] = $billImage;

            Property::create($data);
        }elseif($data['role'] == 'tenant') {
            $tenantData = [
                'user_id' => $user->id,
                'occupation' => $data['occupation'] ?? '',
                'leased_duration' => $data['leased_duration'] ?? '',
                'no_of_occupants' => $data['no_of_occupants'] ?? '',
                'last_status' => $data['last_status'] ?? 0,
            ];

            if (isset($data['last_status']) && $data['last_status'] == 1) {
                $tenantData = array_merge($tenantData, [
                    'last_tenancy' => $data['last_tenancy'],
                    'last_landlord_name' => $data['last_landlord_name'],
                    'last_landlord_contact' => $data['last_landlord_contact'],
                ]);
            }

            Tenant::create($tenantData);
        }elseif($data['role'] === 'service_provider') {
            // $user->services()->sync($data['services'] ?? []);
            // do this for each service
            $cnic = $this->saveCNIC($data);

            foreach ($data['services'] as $service) {
                $data['service_name'] = $service;
                $data['user_id'] = $user->id;
                $data['cnic_front_pic'] = $cnic['cnic_front'];
                $data['cnic_back_pic'] = $cnic['cnic_back'];;
                $data['start_time'] = $data['availability_start_time'];
                $data['end_time'] = $data['availability_end_time'];
                
                $service = Service::create($data);
            }

            if ($data['certification'] == 'yes') {
                $user->certification  = $this->saveCertification($data);
            }

            $user->save();
        }

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
            return $success;
        } else {
            return false;
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
