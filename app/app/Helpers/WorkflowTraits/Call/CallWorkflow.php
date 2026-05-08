<?php

namespace App\Helpers\WorkflowTraits\Call;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\Transformers\CallTransformer;
use DateTime;
use DateInterval;


trait CallWorkflow {
    private function getCallData($direction, $start, $end)
    {
      $user = $this->getUser($request);
      $calls = Call::where('created_at', '>=', $start)
                           ->where('created_at', '<=', $end)
                            ->where('user_id', '=', $user->id);
      return $calls->count();
    }
    public function callData(Request $request, $callId)
    {
        $call = Call::with(['speakers', 'chapters', 'actionItems'])->where('api_id', '=', $callId)->firstOrFail();
        if (!$this->hasPermissions($request, $call, 'manage_calls')) {
            return $this->response->errorForbidden();
        }
        $info = [
            'ai_summary' => (new CallTransformer())->aiSummary($call),
        ];
        return $this->response->array($info);
    }
    public function listCalls(Request $request)
    {
        $callId = NULL;
        if ($request->has("call_id")) {
            $callId = $request->get("call_id");
        } else {
            if ($request->has("callId")) {
                $callId = $request->get("callId");
            } else {
                if ($request->has("id")) {
                    $callId = $request->get("id");
                }
            }
        }

        if (!empty($callId)) {
            return $this->callData($request, $callId);
        } else {
            return $this->response->errorBadRequest("Please pass call_id to fetch the call summary.");
        }
    }
    public function updateCall(Request $request, $callId)
    {
        $call = Call::where('api_id', $callId)->firstOrFail();
        $data = $request->json()->all();
        $call->update( $data );
        return $this->response->noContent();
    }
    
}
