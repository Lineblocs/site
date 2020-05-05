<?php
//require_once('./vendor/autoload.php');
use \App\User;
//use \Config;
use \App\Extension;
use \App\Flow;
use \App\DIDNumber;
use \App\Helpers\MainHelper;
$exts = Extension::all();
foreach ($exts as $extension) {
  if (is_null($extension->public_id)) {
    $id = MainHelper::createApiId(Extension::$publicPrefix);
    $extension->update(['public_id' => $id]);
  }
}
$flows = Flow::all();
foreach ($flows as $flow) {
  if (is_null($flow->public_id)) {
    $id = MainHelper::createApiId(Flow::$publicPrefix);
    $flow->update(['public_id' => $id]);
  }
}
$dids = DIDNumber::all();
foreach ($dids as $did) {
  if (is_null($did->public_id)) {
    $id = MainHelper::createApiId(DIDNumber::$publicPrefix);
    $did->update(['public_id' => $id]);
  }
}

  


  

  

