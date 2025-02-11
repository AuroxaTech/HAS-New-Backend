<?php

namespace App\Interfaces\Auth;

interface AuthRepositoryInterface
{
    public function create(array $data);
    public function login(array $data);
    public function updateProfile(array $data);
    public function updatePassword(array $data);
}
