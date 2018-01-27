<?php

namespace Roitech\Geolocation;

interface GeolocationImplementation
{

    public function getCountry();

    public function getCity();

    public function getCoordinates();

}