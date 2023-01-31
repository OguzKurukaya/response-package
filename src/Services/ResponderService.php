<?php

namespace Oguz\ResponsePackage\Services;


class ResponderService
{

    public const UNRESOLVED_TYPE = 'unresolved_response';
    public const FLAG_IS_ERROR = 'error';
    public const FLAG_IS_SUCCESS = 'success';

    public const UNEXPECTED_ERROR = 400;
    public const UNEXPECTED_TYPE = "error_types folder couldn't found in project";
    public const ERROR_TYPES_FOLDER = 'error_types.Errors';

    public array $response;
    public bool $newVersionResponse;


    public function __construct(array $response = []) {
        $this->setResponse($response);

        $this->newVersionResponse = true;
    }

    public function resolve(array $arguments): ResponderService
    {
        $this->parseArguments($arguments);
        return $this;
    }

    public function toArray(): array
    {
        return $this->getResponse();
    }

    private function parseArguments(array $arguments)
    {
        $this->handleMeta($arguments['meta'] ?? []);

        if ( !isset($arguments['data']) ){
            $this->response['data'] = [];
        }else {
            $this->response['data'] = $arguments['data'];
        }

        if ( $this->isNewVersionResponse() )
            $this->clearResponse();
    }

    private function handleMeta(array $meta = [])
    {
        if (is_null(config(self::ERROR_TYPES_FOLDER))){
         $this->response['meta'] = [
             "flag" =>  self::FLAG_IS_ERROR,
             "code" => self::UNEXPECTED_ERROR,
             'type' => self::UNEXPECTED_TYPE
         ];
         return;
        }
        $codeStartsWith = substr($meta['code'] ?? self::UNEXPECTED_ERROR,0,1);

        $this->response['meta'] = [
            "flag" => $codeStartsWith == 2 ? self::FLAG_IS_SUCCESS : self::FLAG_IS_ERROR,
            "code" => $meta['code'] ?? self::UNEXPECTED_ERROR,
            'type' => $meta['type'] ??
                config(self::ERROR_TYPES_FOLDER)[
                    ($meta['code'] ?? self::UNEXPECTED_ERROR)
                ] ?? self::UNRESOLVED_TYPE
        ];
    }

    /**
     * @param array $response
     * @return ResponderService
     */
    public function setResponse(array $response): ResponderService
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    private function clearResponse()
    {
        $responseTMP = [];
        foreach ($this->response['meta'] as $key => $response) {
            $responseTMP[$key] = $response;
        }
        $responseTMP["data"] = $this->response['data'];

        $this->response = $responseTMP;
    }

    /**
     * @param bool $newVersionResponse
     * @return ResponderService
     */
    public function setNewVersionResponse(bool $newVersionResponse): ResponderService
    {
        $this->newVersionResponse = $newVersionResponse;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNewVersionResponse(): bool
    {
        return $this->newVersionResponse;
    }

}
