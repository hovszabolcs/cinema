<?php /** @noinspection PhpClassCanBeReadonlyInspection -- extendable */

namespace App\Services\Auth;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

class AuthInfo implements AuthResponse
{
    public function __construct(
        readonly public User           $user,
        readonly public NewAccessToken $token
    ) {}

    public function getUser(): User
    {
        return $this->user;
    }

    public function getToken(): NewAccessToken
    {
        return $this->token;
    }
}
