<?php

namespace services\Callers;


use Illuminate\Support\Facades\Facade;

/**
 * Class FixtureCaller
 * @package services\Callers
 */
class FixtureCaller extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\FixtureService\FixtureService';
    }
}
