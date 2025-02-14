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
use Exception;
use Auth;
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
            if ($data['type'] && $data['city'] && $data['amount'] && $data['address'] && $data['lat'] && $data['long'] && $data['area_range'] && $data['bedroom'] && $data['bathroom']) {
                $billImage = $this->saveBill($data);
                $propertyImages = $this->savePropertyImages($data);
                $data['user_id'] = $user->id;
                $data['images'] = $propertyImages;
                $data['electricity_bill'] = $billImage;

                Property::create($data);
            }
        }elseif($data['role'] == 'tenant') {
            if ($data['occupation'] && $data['leased_duration'] && $data['no_of_occupants']) {
                $tenantData = [
                    'user_id' => $user->id,
                    'occupation' => $data['occupation'],
                    'leased_duration' => $data['leased_duration'],
                    'no_of_occupants' => $data['no_of_occupants'],
                    'last_status' => $data['last_status'],
                ];

                if ($data['last_status'] == 1) {
                    $tenantData = array_merge($tenantData, [
                        'last_tenancy' => $data['last_tenancy'],
                        'last_landlord_name' => $data['last_landlord_name'],
                        'last_landlord_contact' => $data['last_landlord_contact'],
                    ]);
                }

                Tenant::create($tenantData);
            } else {
                throw new Exception('Invalid data');
            }
        }elseif($data['role'] === 'service_provider') {
            if ($data['services'] && $data['year_experience'] && $data['availability_start_time'] && $data['availability_end_time'] && $data['certification']) {
                $cnic = $this->saveCNIC($data);
                $user->cnic_front = $cnic['cnic_front'];
                $user->cnic_back = $cnic['cnic_back'];
                $user->services()->attach($data['services']);
                $user->year_experience = $data['year_experience'];
                $user->availability_start_time = $data['availability_start_time'];
                $user->availability_end_time = $data['availability_end_time'];

                if ($data['certification'] == 'yes') {
                    $user->file  = $this->saveCertification($data);
                    
                }

                $user->save();
            } else {
                throw new Exception('All Fields are required');
            }
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
