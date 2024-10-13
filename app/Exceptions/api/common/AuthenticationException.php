<?php

namespace App\Exceptions\api\common;

class AuthenticationException extends ApiException {
    protected int $httpCode = 403;
}
