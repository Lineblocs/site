<?php

return [
  'trial' => [
    'ports' => 25,
    'extensions' => 10,
    'recording_space' => '1024MB',
    'numbers' => 1,
    'call_duration' => '10 minutes',
  ],
  'standard' => [
    'ports' => 50,
    'extensions' => 100,
    'recording_space' => '10240MB',
    'numbers' => 25,
    'call_duration' => 'Unlimited'
  ],
  'premium' => [
    'ports' => 200,
    'extensions' => 500,
    'recording_space' => '100000MB',
    'numbers' => 100,
    'call_duration' => 'Unlimited'
  ]


];
