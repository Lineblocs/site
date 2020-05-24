<?php

$calls = \App\Call::where('workspace_id', '66')->get();
$output = "From,To,Duration,Status\r\n";
foreach ($calls as $call) {
  $output .= sprintf("%s,%s,%s,%s", $call->from,$call->to, $call->duration,$call->status)."\r\n";
}
file_put_contents("./output.csv", $output);

  

