<?php

return [

    'dev_external_ip' => '62.166.52.28',
    'implementations' => [
        'geobytes' => [
            'url' => 'http://gd.geobytes.com/GetCityDetails?fqcn=%s', //don't forget the placeholder for the IP
            'fields' => [
                'country' => 'geobytescountry',
                'city' => 'geobytescity',
                'latitude' => 'geobyteslatitude',
                'longitude' => 'geobyteslongitude'
            ]
        ],
        'freegeoip' => [
            'url' => 'http://freegeoip.net/json/%s', //don't forget the placeholder for the IP
            'fields' => [
                'country' => 'country_name',
                'city' => 'city',
                'latitude' => 'latitude',
                'longitude' => 'longitude'
            ]
        ],
        'extremeiplookup' => [
            'url' => 'http://extreme-ip-lookup.com/json/%s', //don't forget the placeholder for the IP
            'fields' => [
                'country' => 'country',
                'city' => 'city',
                'latitude' => 'lat',
                'longitude' => 'lon'
            ]
        ],
        'geoplugin' => [
            'url' => 'http://www.geoplugin.net/json.gp?ip=%s',
            'fields' => [
                'country' => 'geoplugin_countryName',
                'city' => 'geoplugin_city',
                'latitude' => 'geoplugin_latitude',
                'longitude' => 'geoplugin_longitude'
            ]
        ]
    ]

];