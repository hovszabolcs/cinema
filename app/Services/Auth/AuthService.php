<?php

namespace App\Services\Auth;

use App\Exceptions\api\common\AuthenticationException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @throws AuthenticationException
     */
    public function login($email, $password): AuthResponseInterface {
        /** @var User $user */
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new AuthenticationException('Rossz felhasználónév, vagy jelszó.');
        }

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
        $request->user()->tokens()->delete();
    }
}
