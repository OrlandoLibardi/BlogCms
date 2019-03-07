<?php

namespace OrlandoLibardi\BlogCms\app\Providers;

use Illuminate\Support\Facades\Facade;

class OlCmsBlogFacada extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'OlCmsBlog';
    }
}