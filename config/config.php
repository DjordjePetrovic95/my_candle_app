<?php

function config(string $key): mixed
{
    $config = [
        'db' => [
            'host' => 'sql106.infinityfree.com',
            'user' => 'if0_37451772',
            'pass' => 'dMYnvXkzyBMJKu',
            'db_name' => 'if0_37451772_candle_shop',
        ],
        'app' => [
            'subdirectory' => '',
            'app_url' => 'mojsajt.rf.gd/',
            'public_url' => 'mojsajt.rf.gd/',
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
