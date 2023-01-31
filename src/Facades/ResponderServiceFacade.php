<?php

namespace Oguz\ResponsePackage\Facades;


use Illuminate\Support\Facades\Facade;


/**
 * @method static hasError(): bool
 * @method static setError(...$error)
 * @method static getError()
 */
class ResponderServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ErrorResponder';
    }

}
