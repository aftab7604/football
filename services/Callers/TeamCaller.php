<?php

namespace services\Callers;


use Illuminate\Support\Facades\Facade;

/**
 * Class TeamCaller
 * @package services\Callers
 */
class TeamCaller extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\TeamService\TeamService';
    }
}
