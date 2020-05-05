<?php

use App\MacroFunction;
use App\MacroTemplate;

$code = <<<EOF

EOF;
$params = json_encode([
  [
    'type' => 'text',
    'name' => 'timezone',
    'placeholder' => 'America/Toronto'
  ].
[
    'type' => 'text',
    'name' => 'start day of week',
    'placeholder' => 'Monday'
  ].
[
    'type' => 'text',
    'name' => 'start day of week',
    'placeholder' => 'Friday'

  ].
[
    'type' => 'text',
    'name' => 'start hour of day',
    'placeholder' => '09'

  ].
[
    'type' => 'text',
    'name' => 'end hour of day',
    'placeholder' => '17'

  ]
]);
$template = MacroTemplate::create([
  'title' => 'Business Hours Check',
  'code' => $code,
  'changeable_params' => $params
]);
$code = <<<EOF

EOF;
$paams = json_encode([
  [
    'type' => 'text',
    'name' => 'destination email',
    'placeholder' => 'you@example.org'
  ]
]);
$template = MacroTemplate::create([
  'title' => 'Send Voicemail To Email',
  'code' => $code,
  'changeable_params' => $params
]);


