<?php

use App\Exceptions\api\common\ApiException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $errorSchema = [
            403 => [
                'type' => 'error',
                'code' => 401,
                'message' => 'Forbidden'
            ],
            404 => [
                'type' => 'error',
                'code' => 404,
                'message' => 'Not Found'
            ]
        ];

        $exceptions->render(function(ApiException $e, Request $request) use ($errorSchema) {
            return response()->json($e, $e->getHttpCode());
        });

        $exceptions->render(using: function(AuthenticationException $e, Request $request) use ($errorSchema) {
            if ($request->is('api/*')) {
                return response()->json($errorSchema[403], 403);
            }
        });

        $exceptions->render(function(NotFoundHttpException $e, Request $request) use ($errorSchema) {
            if ($request->is('api/*')) {
                return response()->json($errorSchema[404], 404);
            }
        });


    })->create();
