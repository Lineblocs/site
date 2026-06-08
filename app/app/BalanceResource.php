<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\MainHelper;
use App\Helpers\BillingDataHelper;
use App\User;
use App\WorkspaceUser;

class BalanceResource extends Model {
  public static function create($attrs=array(), $plan=NULL) {
    $user = User::findOrFail($attrs['user_id']);
    if (!empty($attrs['deduplication_key'])) {
      $query = static::where('deduplication_key', $attrs['deduplication_key']);
      if (!empty($attrs['workspace_id'])) {
        $query->where('workspace_id', $attrs['workspace_id']);
      }
      $existing = $query->first();
      if ($existing) {
        return $existing;
      }
    }
    if (empty($attrs['workspace_id'])) {
      $workspaceUser = WorkspaceUser::where('user_id', $user->id)->first();
      if ($workspaceUser) {
        $attrs['workspace_id'] = $workspaceUser->workspace_id;
      }
    }
    $record = parent::create( $attrs );
    $billing = BillingDataHelper::getBillingInfo($user, $plan);
    $update = [];
    $record->update($update);
    return $record;

  }

}


