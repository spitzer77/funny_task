<?php

$data = [
    [
        'country_name' => 'USA',
        'country_code' => 'US',
        'city_name' => 'New York',
        'lat' => '40.7127753',
        'lng' => '-74.0059728',
    ],
    [
        'country_name' => 'USA',
        'country_code' => 'US',
        'city_name' => 'Los Angeles',
        'lat' => '34.0522342',
        'lng' => '-118.2436849',
    ],
    [
        'country_name' => 'Philippines',
        'country_code' => 'PH',
        'city_name' => 'Manila',
        'lat' => '14.5995124',
        'lng' => '120.9842195',
    ],
    [
        'country_name' => 'Philippines',
        'country_code' => 'PH',
        'city_name' => 'Cebu',
        'lat' => '10.3156993',
        'lng' => '123.8854377',
    ]
];

function transformKeys($data): array
{
    return array_map(function ($key) {
        return ucfirst(str_replace('_', ' ', $key));
    }, array_keys($data));
}

$transformedKeys = transformKeys($data[0]);

$formatCallback = function ($item) {
    return implode(',', [
            $item['country_name'],
            $item['country_code'],
            '"' . $item['city_name'] . '"',
            $item['lat'],
            $item['lng'],
        ]) . PHP_EOL;
};

$csvData = '';
if ($transformedKeys && $formatCallback) {
    $csvData .= implode(',', $transformedKeys) . PHP_EOL;
    $csvData .= implode('', array_map($formatCallback, $data));
}

try {
    file_put_contents('output.csv', $csvData);
} catch (Exception $e) {
    echo $e->getMessage();
}
