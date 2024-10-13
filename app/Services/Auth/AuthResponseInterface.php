<?php

namespace App\Services\Auth;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

interface AuthResponseInterface
{
    public function getUser(): User;
    public function getToken(): NewAccessToken;
}
