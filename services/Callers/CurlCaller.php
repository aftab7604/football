<?php

namespace services\Callers;


use Illuminate\Support\Facades\Facade;

/**
 * Class CurlCaller
 * @package services\Callers
 */
class CurlCaller extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\CurlService\CurlService';
    }
}
