<?php

namespace App\Http\Controllers;

use App\Exceptions\api\common\AuthenticationException;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\LoginResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    /**
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): LoginResource {
        $loginData = $this
            ->authService
            ->login($request->only('email', 'password'));

        return new LoginResource($loginData);
    }

    public function logout(Request $request): BaseResource {
        $this->authService->logout($request);
        return new BaseResource(null);
    }
}
