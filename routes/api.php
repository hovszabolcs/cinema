<?php

use App\Http\Controllers\AuthController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')
    ->prefix('v1')
    ->group(function() {

        Route::post('/login', [AuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function() {
            Route::post('/logout', [AuthController::class, 'logout']);

            Route::get('/user', function (Request $request) {
                return new UserResource($request->user());
            });

        });



});


