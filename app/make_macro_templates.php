<?php

use App\MacroFunction;
use App\MacroTemplate;
$business = MacroFunction::where('name','=', 'Business Hours Check')->first();
$template = MacroTemplate::create([
  'name' => 'Business Hours Check',
  'code' => $business['code']
]);
$email = MacroFunction::where('name','=', 'Send Voicemail To Email')->first();
$template = MacroTemplate::create([
  'name' => 'Send Voicemail To Email',
  'code' => $email['code']
]);


