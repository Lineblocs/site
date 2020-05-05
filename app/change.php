<?php
$params = json_encode([
  [
    'type' => 'text',
    'name' => 'timezone',
    'placeholder' => 'America/Toronto'
  ],
[
    'type' => 'text',
    'name' => 'start day of week',
    'placeholder' => 'Monday'
  ],
[
    'type' => 'text',
    'name' => 'start day of week',
    'placeholder' => 'Friday'

  ],
[
    'type' => 'text',
    'name' => 'start hour of day',
    'placeholder' => '09'

  ],
[
    'type' => 'text',
    'name' => 'end hour of day',
    'placeholder' => '17'

  ]
]);
$template = \App\MacroTemplate::get()[0];
$template->update(['changeable_params' => $params]);
