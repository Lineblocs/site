<?php namespace App\Http\Controllers\Api\BYO\DID;

use \App\Http\Controllers\Api\BYO\BYOController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\BYODIDNumber; 
use \App\BYODIDNumberRoute; 
use \App\Transformers\BYODIDNumberTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\WorkflowTraits\BYO\DIDNumberWorkflow;
use Mail;
use Config;
use File;



class BYODIDNumberController extends BYOController {
  use DIDNumberWorkflow;

}

