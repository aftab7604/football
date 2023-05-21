<?php

namespace services\Callers;


use Illuminate\Support\Facades\Facade;

/**
 * Class ImageCaller
 * @package services\Callers
 */
class ImageCaller extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\ImageService\ImageService';
    }
}
