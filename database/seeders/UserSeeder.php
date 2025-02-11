<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'full_name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'user_name' => 'admin',
            'password' => Hash::make('password'), // Hashed password
            'phone_number' => '123456789',
            'role' => 'admin', // Storing role as 'admin'
            'address' => '123 Admin St',
            'postal_code' => '12345',
            'profile_image' => null,
            'platform' => 'web',
            'device_token' => Str::random(60),
            'approved_at' => true,
            'is_verified' => true,
            'verification_token' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
