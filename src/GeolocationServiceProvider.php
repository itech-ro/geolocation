<?php

namespace Roitech\Geolocation;

use Illuminate\Support\ServiceProvider;
use Roitech\Geolocation\Providers\Geobytes;
use Roitech\Geolocation\Providers\DefaultProvider;

class GeolocationServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('geolocation', 'Roitech\Geolocation\Geolocation');
    }

    public function boot() {
        $this->mergeConfigFrom(__DIR__.'/config/providers.php', 'providers');
    }

}