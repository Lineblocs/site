<?php

namespace App\Http\Controllers\Api\Internal\Conference;
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



class ConferenceController extends ApiAuthController {
    public function createConference(Request $request)
    {
      $data = $request->json()->all();
      $user = User::findOrFail($data['user_id']);
      $workspace = Workspace::findOrFail($data['workspace_id']);
      $started = new DateTime();
      $current = Conference::where('workspace_id', $workspace)->where('name', $data['name'])->first();

      if ($current) {
        return $this->response->array($urrent->toArray())->withHeader("X-Conference-ID", $conference->id);
      }
      $conference = Conference::create([
        'name' => $data['naem'],
        'workspace_id' => $data['workspace_id']
      ]);
      return $this->response->array($urrent->toArray())->withHeader("X-Conference-ID", $conference->id);
    }
    public function updateCall(Request $request)
    {
      $data = $request->json()->all();
      $call = Call::findOrFail($data['call_id']);
      $params = [];
      if ($data['status'] == "completed") {
        $params['ended_at'] = new DateTime();
      }
      $params['status'] = $data['status'];
      $call->update( $params );
    }

 
}

