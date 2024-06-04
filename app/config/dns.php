<?php

use App\Helpers\MainHelper;

$default_ip = MainHelper::getLocalIP();
$ingress = env('INGRESS_IP', $default_ip);

return [
  'ingress' => $ingress
];
