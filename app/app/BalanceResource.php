<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\MainHelper;
use App\Helpers\BillingDataHelper;
use App\User;

class BalanceResource extends Model {
  public static function create($attrs=array(), $plan=NULL) {
    $user = User::findOrFail($attrs['user_id']);
    $record = parent::create( $attrs );
    $billing = BillingDataHelper::getBillingInfo($user, $plan);
    $update = [];
    $update['balance'] = $billing['accountBalance'];
    $record->update($update);
    return $record;

  }

}


