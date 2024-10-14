<?php

namespace App\Services\Auth;

use App\Exceptions\api\common\AuthenticationException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @throws AuthenticationException
     * @params ['email' = ?, 'password' = ?] $credentials
     */
    public function login(array $credentials): AuthResponseInterface {
        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException(__('auth.failed'));
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('accessToken', [
            // TODO: getUserAbilities
            'movie' => [
                'read' => true,
                'write' => true
            ],
            'screening' => [
                'read' => true,
                'write' => true
            ]
        ]);

        return new AuthInfoInterface($user, $token);
    }

    public function logout(Request $request): void {
        $request->user()->currentAccessToken()->delete();
    }
}
