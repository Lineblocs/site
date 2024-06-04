<?php
$ingress = env('INGRESS_IP', $_SERVER['SERVER_ADDR']);

return [
  'ingress' => $ingress
];
