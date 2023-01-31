<?php


use Illuminate\Http\JsonResponse;
use Oguz\ResponsePackage\Services\ResponderService;

if (!function_exists('resolve_response')){

    function resolve_response(...$arguments): array|ResponderService|JsonResponse {
        $responder = new ResponderService();

        if (isset($arguments['newVersionResponse'])) {
            $responder->setNewVersionResponse(
                $arguments['newVersionResponse']
            );
        }

        $resolved = $responder->resolve($arguments);


        if (isset($arguments['pure']) && $arguments['pure']) {
            return $resolved;
        }


        if (isset($arguments['castArray']) && $arguments['castArray']) {
            return $resolved->toArray();
        }


        return response()->json(
            $resolved->toArray()
        );
    }
}
