<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\MainHelper;
use App\User;

class BalanceResource extends Model {
  public static function create($attrs=array()) {
    $user = User::findOrFail($attrs['user_id']);
    $record = parent::create( $attrs );
    $billing = $user->getBillingInfo();
    $update = [];
    $update['balance'] = $billing['accountBalance'];
    $record->update($update);
    return $record;

  }

}


