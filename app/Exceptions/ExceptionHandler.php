<?php

namespace App\Exceptions;

use App\Exceptions\api\common\ApiException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class ExceptionHandler
{
    private array $errorMessages = [
        400 => 'errors.bad_request',
        401 => 'errors.unauthorized',
        403 => 'errors.forbidden',
        404 => 'errors.not_found',
        500 => 'errors.unknown_error'
    ];

    public function __construct(
        private Exceptions $exceptions
    )
    {
    }

    public function handleExceptions()
    {

        $this->exceptions->render(function (ApiException $e, Request $request) {
            return response()->json($e, $e->getHttpCode());
        });

        $this->exceptions->render(using: function (AuthenticationException $e, Request $request) {
            return $this->makeResponse(401, $request->is('api/*'));
        });

        $this->exceptions->render(function (RouteNotFoundException|NotFoundHttpException $e, Request $request) {
            return $this->makeResponse(404, $request->is('api/*'));
        });

        $this->exceptions->render(function (ValidationException $e, Request $request) {
            $isApi = $request->is('api/*');

            return $this->makeResponse(400, $isApi, $e);
        });

        $this->exceptions->render(function (Exception $e, Request $request) {
            return $this->makeResponse(500, $request->is('api/*'));
        });

        return $this->exceptions;
    }

    private function makeResponse(int $code, bool $isAPI, ?Exception $e = null)
    {
        $code = $code ?: ($e ? $e->getCode() : $code);

        return $isAPI
            ? response()->json(
                [
                    ...$this->getAPIErrorResponseSchema(),
                    'message' => $e ? $e->getMessage() : __($this->errorMessages[$code])
                ], $code)
            : response(__($this->errorMessages[$code]), $code);
    }

    protected function getAPIErrorResponseSchema(): array
    {
        return ApiException::RESPONSE_SCHEMA;
    }
}
