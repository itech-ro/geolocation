<?php

namespace Roitech\Geolocation\Facades;

use Illuminate\Support\Facades\Facade;

class GeolocationFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'geolocation';
    }

}