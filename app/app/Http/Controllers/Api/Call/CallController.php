<?php

namespace App\Http\Controllers\Api\Call;
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



class CallController extends ApiAuthController {
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
        MainHelper::addSearch($request, $calls, ['from', 'to', 'status']);
        return $this->response->paginator($calls->paginate($paginate), new CallTransformer);
    }
    public function graphData(Request $request)
    {
      $dayCount = 7;
      $currentDay = 0;
      $labels = array();
      $data = array(
        "inbound" => array(),
        "outbound" => array()
      );
      $now = new DateTime();
      $start = clone $now;
      $start->sub(new DateInterval('P' . $dayCount . 'D'));
      $cloned1 = clone $start;
      while ($currentDay != $dayCount) {
        $labels[] = $cloned1->format("M-d");
        $cloned2 = clone $cloned1;
        $cloned2->add(new DateInterval('P1D'));
        $data['inbound'][] = $this->getCallData('inbound', $cloned1, $cloned2);
        //$data['inbound'][] = rand(1, 20);
        $data['outbound'][] = $this->getCallData('outbound', $cloned1, $cloned2);
        //$data['outbound'][] = rand(1,20);
        $cloned1->add(new DateInterval('P1D'));
        $currentDay = $currentDay + 1;
      }
        return $this->response->array(['labels' => $labels, 'data' => $data]);
    }
 
}

