<?php

namespace App\Http\Controllers\Api\Internal\Debit;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\UserDebit;
use \App\Helpers\MainHelper;
use \App\Transformers\CallTransformer;

use DateTime;
use DateInterval;
use \App\CallRate;



class DebitController extends ApiAuthController {
    public function createDebit(Request $request)
    {
      $data = $request->json()->all();
      $info = [
        'user_id' => $data['user_id'],
        'workspace_id' => $data['workspace_id'],
        'source' => $data['source']
      ];
      
      $rate = MainHelper::lookupBestCallRate($data['number'], $data['type']);
      if (!$rate) {
        return $this->response->errorInternal('could not find call rate..');
      }
      $seconds = (int) $data['seconds']; 
      $minutes = floor($seconds / 60);
      $rate_value = (float)$rate['call_rate'];
      $dollars = $minutes * $rate_value;

      $cents = MainHelper::toCents( $dollars );
      $user = User::findOrFail($data['user_id']);
      $started = new DateTime();
      $debit = UserDebit::create([
        'user_id' => $user->id,
        'cents' => $cents,
        'source' => $data['source']
      ]);
      //return $this->response->array($debit->toArray())->withHeader("X-Debit-ID", $debit->id);
      return $this->response->noContent();
    }
}

