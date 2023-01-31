<?php


use Illuminate\Http\JsonResponse;
use Oguz\ResponsePackage\Services\ResponderService;

if (!function_exists('resolve_response')){

    function resolve_response(...$arguments): array|ResponderService|JsonResponse {
        # instance responder service
        $responder = new ResponderService();

        # is new version ?
        if (isset($arguments['newVersionResponse'])) {
            $responder->setNewVersionResponse(
                $arguments['newVersionResponse']
            );
        }

        # give the arguments service
        $resolved = $responder->resolve($arguments);

        /*
         * check response type for pure
         * Pure : this type meaning is return to class self
         * */
        if (isset($arguments['pure']) && $arguments['pure']) {
            return $resolved;
        }

        /*
         * check response type for cast array
         * this condition is set for expect result as an array and not an object or json
         * */
        if (isset($arguments['castArray']) && $arguments['castArray']) {
            return $resolved->toArray();
        }

        /*
         * standard json response will return..
         * */
        return response()->json(
            $resolved->toArray()
        );
    }
}
