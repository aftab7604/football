<?php

namespace services\Callers;


use Illuminate\Support\Facades\Facade;

/**
 * Class LeagueCaller
 * @package services\Callers
 */
class LeagueCaller extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\LeagueService\LeagueService';
    }
}
