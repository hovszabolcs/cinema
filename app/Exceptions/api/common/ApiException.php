<?php

namespace App\Exceptions\api\common;

use JsonSerializable;

abstract class ApiException extends \Exception implements JsonSerializable {

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
            'type' => 'error',
            'code' => $this->getHttpCode(),
            'message' =>$this->getMessage(),
        ];
    }
}
