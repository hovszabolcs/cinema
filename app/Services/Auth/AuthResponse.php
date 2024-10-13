<?php

namespace App\Services\Auth;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

interface AuthResponse
{
    public function getUser(): User;
    public function getToken(): NewAccessToken;
}
