<?php

namespace App\Helpers\WorkflowTraits\Call;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\Recording;
use \App\Transformers\CallTransformer;
use DateTime;
use DateInterval;
use App\Helpers\MainHelper;


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
        $call = Call::where('api_id', '=', $callId)->firstOrFail();
        if (!$this->hasPermissions($request, $call, 'manage__calls')) {
            return $this->response->errorForbidden();
        }
        $info = $call->toArray();
        $info['recordings'] = Recording::where('call_id', '=', $call->id)->get()->toArray();
        return $this->response->array($info);
    }
    public function listCalls(Request $request)
    {
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        \Log::info('getting calls for user ' . $user->id);
        $calls = Call::where('user_id', $user->id);
        MainHelper::addSearch($request, $calls, ['from', 'to', 'status', 'direction']);
        return $this->response->paginator($calls->paginate($paginate), new CallTransformer);
    }
}
