<?php

namespace services\Callers;


use Illuminate\Support\Facades\Facade;

/**
 * Class SearchCaller
 * @package services\Callers
 */
class SearchCaller extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\SearchService\SearchService';
    }
}
