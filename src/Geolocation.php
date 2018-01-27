<?php

namespace Roitech\Geolocation;

use Roitech\Geolocation\Exceptions\InvalidGeolocationImplementation;

class Geolocation implements GeolocationImplementation
{
    /**
     * Response data from geolocation providers
     *
     * @var mixed|null
     */
    protected $data = null;

    /**
     * Provider instance
     *
     * @var \Roitech\Geolocation\GeolocationProvider
     */
    protected $provider = null;


    /**
     * Geolocation constructor.
     * @throws \Roitech\Geolocation\Exceptions\InvalidGeolocationImplementation
     */
    public function __construct()
    {
        $provider = config('geolocation.provider');
        $className = 'Roitech\Geolocation\Providers\\' . ucfirst($provider);
        if (!class_exists($className)) {
            throw new InvalidGeolocationImplementation('Invalid implementation: ' . $provider);
        }
        $configuration = config('providers.implementations.' . $provider);
        $ip = $this->getIp();
        $this->provider = new $className($configuration, $ip);
    }

    /**
     * Returns request's IP. Will overwrite local network IP if specified in configuration
     * @return string
     */
    protected function getIp()
    {
        $ip = request()->ip();
        if (filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        )) {
            return $ip;
        }
        return config('providers.dev_external_ip');
    }


    public function getCountry()
    {
        return $this->provider->getCountry();
    }

    public function getCity()
    {
        return $this->provider->getCity();
    }

    public function getCoordinates()
    {
        return $this->provider->getCoordinates();
    }

}