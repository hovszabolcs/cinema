<?php

namespace App\Exceptions\api\common;

class FormException extends ApiException
{
    private string $name = 'fieldName';
    private array $formErrors = [];

    public function setName(string $name): static {
        $this->name = $name;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getFormErrors(): array {
        return $this->formErrors;
    }

    public function addError(FormException $e): static {
        $this->formErrors[$e->getName()] = $e;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [...parent::jsonSerialize(), 'formErrors' => $this->getFormErrors()];
    }
}
