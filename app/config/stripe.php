<?php
$mode = 'test';
$keys = [];
$keys['prod'] = [
    'public_key' => env('STRIPE_KEY'),
    'secret_key' => env('STRIPE_SECRET')
];
$keys['dev'] = [
    'public_key' => env('STRIPE_DEV_KEY'),
    'secret_key' => env('STRIPE_DEV_SECRET')
];
if (env('APP_DEBUG')) {
  return $keys['dev'];
}
return $keys['prod'];
