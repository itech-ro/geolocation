<?php

namespace Roitech\Geolocation\Providers;

use GuzzleHttp\Client;
use Roitech\Geolocation\Exceptions\InvalidConfiguration;
use Roitech\Geolocation\GeolocationImplementation;


class DefaultProvider implements GeolocationImplementation
{
    /**
     * Geolocation provider URL
     * @var string
     */
    protected $url = '';

    /**
     * JSON decoded response from Freegeoip
     * @var stdClass
     */
    protected $data = null;

    /**
     * Array of field names to match with geolocation data
     * @var array
     */
    protected $fields = [];

    /**
     * GeolocationProvider constructor.
     * @param array $configuration
     * @param string $ip
     * @throws InvalidConfiguration
     */
    public function __construct($configuration, $ip)
    {
        if (!isset($configuration['url'])) {
            throw new InvalidConfiguration('Missing URL');
        }
        $this->url = sprintf($configuration['url'], $ip);
        $this->fields = $configuration['fields'];
        $client = new Client();
        $response = $client->get($this->url);
        if ($response->getBody()) {
            $this->data = json_decode((string)$response->getBody());
        }
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->getField('country');
    }

    /**
     * Retrieves an element of the geolocation service response
     * @param $field
     * @return string
     */
    protected function getField($field)
    {
        $response_field = isset($this->fields[$field]) ? $this->fields[$field] : $field;
        if (!is_null($this->data) && isset($this->data->$response_field)) {
            return $this->data->$response_field;
        }
        return '';
    }

    public function getCity()
    {
        return $this->getField('city');
    }

    public function getCoordinates()
    {
        $latitude = $this->getField('latitude');
        $longitude = $this->getField('longitude');
        return [
            'lat' => $latitude,
            'long' => $longitude
        ];
    }

}