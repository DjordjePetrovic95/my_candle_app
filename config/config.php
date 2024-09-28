<?php

function config(string $key): mixed
{
    $config = [
        'db' => [
            'host' => 'candleapp.test',
            'user' => 'root',
            'pass' => '',
            'db_name' => 'candle_shop',
        ],
        'app' => [
            'subdirectory' => '',
            'app_url' => 'http://candleapp.test/',
            'public_url' => 'http://candleapp.test/',
            'app_name' => 'Candle Shop',
        ],
    ];

    $pieces = explode('.', $key);
    $tmp = $config;

    foreach ($pieces as $piece) {
        if (! is_array($tmp) || ! array_key_exists($piece, $tmp)) {
            throw new Exception('Config could not be found: ' . $key);
        }

        $tmp = $tmp[$piece];
    }

    return $tmp;
}
