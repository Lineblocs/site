<?php

namespace App\Http\Controllers\Api\Internal\Call;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Workspace;
use \App\Call;
use \App\Recording;
use \App\Transformers\CallTransformer;
use DateTime;
use DateInterval;



class CallController extends ApiAuthController {
    public function createCall(Request $request)
    {
      $data = $request->json()->all();
      $user = User::findOrFail($data['user_id']);
      $started = new DateTime();
      $call = Call::create([
        'from' => $data['from'],
        'to' => $data['to'],
        'status' => 'in-progress',
        'direction' => $data['direction'],
        'duration' => 0,
        'user_id' => $user->id,
        'workspace_id' => $data['workspace_id'],
        'started_at' => $started
      ]);
      return $this->response->array($call->toArray())->withHeader("X-Call-ID", $call->id);
    }
    public function updateCall(Request $request)
    {
      $data = $request->json()->all();
      $call = Call::findOrFail($data['call_id']);
      $params = [];
      if ($data['status'] == "ended") {
        $params['ended_at'] = new DateTime();
      }
      $params['status'] = $data['status'];
      $call->update( $params );
    }

 
}

