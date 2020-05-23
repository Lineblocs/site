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
use App\Helpers\WorkflowTraits\Call\CallWorkflow;



class CallController extends ApiAuthController {
  use CallWorkflow;
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

