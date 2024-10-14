<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\LoginResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="API Documentation for Movies", version="0.1"),
 */


final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     tags={"Authentication"},
     *     summary="Login to the application",
     *     description="Authenticate a user with email and password",
     *     operationId="login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="test@example.com"),
     *             @OA\Property(property="password", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="type", type="string", example="response"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Test User"),
     *                 @OA\Property(property="email", type="string", example="test@example.com")
     *             ),
     *             @OA\Property(property="token", type="string", example="a2|Rsi8wbIq5r2oEpM2hKlRWZorDfp9CkTvSbrtVQZqa6714dec")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Invalid login credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="type", type="string", example="error"),
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="code", type="integer", example=403),
     *             @OA\Property(property="message", type="string", example="Rossz felhasználónév, vagy jelszó.")
     *         )
     *     )
     * )
     */
    public function login(LoginRequest $request): LoginResource {
        $loginData = $this
            ->authService
            ->login($request->only('email', 'password'));

        return new LoginResource($loginData);
    }


    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     tags={"Authentication"},
     *     summary="Logout from the application",
     *     description="Logs out the authenticated user by invalidating the token",
     *     operationId="logout",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\JsonContent(
     *             @OA\Property(property="type", type="string", example="response"),
     *             @OA\Property(property="success", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="type", type="string", example="error"),
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Unauthorized.")
     *         )
     *     )
     * )
     */
    public function logout(Request $request): BaseResource {
        $this->authService->logout($request);
        return new BaseResource(null);
    }
}
