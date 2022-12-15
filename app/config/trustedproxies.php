<?php

return [
    'proxies' => [
    ],

    // These are defaults already set in the config:
    'headers' => [
        (defined('Illuminate\Http\Request::HEADER_FORWARDED') ? Illuminate\Http\Request::HEADER_FORWARDED : 'forwarded') => 'FORWARDED',
        \Illuminate\Http\Request::HEADER_CLIENT_IP    => 'X_FORWARDED_FOR',
        \Illuminate\Http\Request::HEADER_CLIENT_HOST  => 'X_FORWARDED_HOST',
        \Illuminate\Http\Request::HEADER_CLIENT_PROTO => 'X_FORWARDED_PROTO',
        \Illuminate\Http\Request::HEADER_CLIENT_PORT  => 'X_FORWARDED_PORT',
    ]
];
