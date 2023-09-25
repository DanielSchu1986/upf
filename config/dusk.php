<?php

return [
    'driver' => env('DUSK_DRIVER', 'chromedriver'), // Pode ser 'chromedriver' ou 'selenium'
    'path' => base_path('tests/Browser/screenshots'),
    'environments' => [
        'default' => [
            'driver' => env('DUSK_DRIVER', 'chromedriver'),
            'chromedriver' => env('DUSK_CHROMEDRIVER', '/usr/bin/chromedriver'), // Caminho para o executável do Chromedriver
            'selenium' => env('DUSK_SELENIUM', 'http://localhost:9515'),
        ],
    ],
];
