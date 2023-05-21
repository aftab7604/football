<?php

namespace services\Callers;


use Illuminate\Support\Facades\Facade;

/**
 * Class CategoryCaller
 * @package services\Callers
 */
class CategoryCaller extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\CategoryService\CategoryService';
    }
}
