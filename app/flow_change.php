<?php
use App\Flow;
$flow = Flow::where('public_id', 'f-ba7c077a-cdd1-4ec6-adae-631a242e94fc')->first();
$data = $flow->flow_json;
//file_put_contents("./backups/edwin-flow.json", $data);
$change1 = str_replace(array("158.69.54.90", "51.79.86.220"), "telefederal.paymynumbers.com", $data);
$flow->update([
  'flow_json' => $change1
]);
