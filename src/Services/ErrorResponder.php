<?php

namespace Oguz\ResponsePackage\Services;

use Illuminate\Http\JsonResponse;

class ErrorResponder extends ResponderService
{

    private array|ResponderService|JsonResponse $error = [];
    private bool $hasError = false;

    public function __construct(array $response = [])
    {
        parent::__construct($response);
    }

    /**
     * @return array|ResponderService|JsonResponse
     */
    public function getError(): array|ResponderService|JsonResponse
    {
        return $this->error;
    }

    /**
     * @param mixed ...$arguments
     * @return ErrorResponder
     */
    public function setError(...$arguments): ErrorResponder
    {
        $resolved = $this->resolve($arguments);
        $this->error = response()->json(
            $resolved->toArray()
        );
        $this->setHasError(true);
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasError(): bool
    {
        return $this->hasError;
    }

    /**
     * @param bool $hasError
     * @return ErrorResponder
     */
    public function setHasError(bool $hasError): ErrorResponder
    {
        $this->hasError = $hasError;
        return $this;
    }



}
