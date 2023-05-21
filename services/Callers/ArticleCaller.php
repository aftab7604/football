<?php

namespace services\Callers;


use Illuminate\Support\Facades\Facade;

/**
 * Class ArticleCaller
 * @package services\Callers
 */
class ArticleCaller extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\ArticleService\ArticleService';
    }
}
