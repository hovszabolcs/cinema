<?php

namespace App\Exceptions\api\common;

use JsonSerializable;

abstract class ApiException extends \Exception implements JsonSerializable {

    const RESPONSE_SCHEMA = [
      'type' => 'error',
      'success' => false
    ];

    protected int $httpCode = 400;

    public function setHttpCode(int $httpCode): static {
        $this->httpCode = $httpCode;
        return $this;
    }

    public function getHttpCode(): int {
        return $this->httpCode;
    }

    public function jsonSerialize(): array
    {
        return [
            ...self::RESPONSE_SCHEMA,
            'code'      => $this->getHttpCode(),
            'message'   => $this->getMessage(),
        ];
    }
}
