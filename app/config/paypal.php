<?php
$keys = [];

$keys['dev'] = [
  'mode' => 'sandbox',
  'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''), 
  'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''), 
];
$keys['prod'] = [
  'mode' => 'live',
  'client_id' => env('PAYPAL_LIVE_CLIENT_ID', ''), 
  'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET', '')
];
if (env('APP_DEBUG')) {
  return $keys['dev'];
}
return $keys['prod'];
