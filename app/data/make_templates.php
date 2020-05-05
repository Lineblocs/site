<?php

use App\Flow;
use App\FlowTemplate;
use App\Helpers\MainHelper;
$forward = Flow::where('name','=', 'Call Forward Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $forward->flow_json,
  'name' => 'Call Forward',
  'description' => 'A basic example of call forwarding',
  'category' => 'Phone System'
]);
$ivr = Flow::where('name','=', 'Simple IVR Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $ivr->flow_json,
  'name' => 'Simple IVR',
  'description' => 'A setup for forwarding calls to 3 sections based on user selection',
  'category' => 'Phone System'
]);
$voicemail = Flow::where('name','=', 'Voicemail Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $voicemail->flow_json,
  'name' => 'Voicemail Example',
  'description' => 'Forward calls to voicemail when there is a no answer dial status',
  'category' => 'Phone System'
]);
$voicemail = Flow::where('name','=', 'Queue Example Template')->first();
$template = FlowTemplate::create([
  'flow_json' => $voicemail->flow_json,
  'name' => 'Queue Example',
  'description' => 'Forward calls to voicemail when there is a no answer dial status',
  'category' => 'Phone System'
]);


require_once(__DIR__."/functions/cold_transfer.php");
require_once(__DIR__."/functions/check_voicemail.php");
