<?php

namespace App;

use App\Helpers\MainHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\WorkspaceUser;
class Workspace extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "workspaces";
  protected $casts = array(
    "byo_enabled" => "boolean"
    );
  public function toArray() {
        $array = parent::toArray();
        $array['domain'] = MainHelper::makeDomainName($this->name);
      return $array;
      }
  public function makeDomainName($region='') {
    return sprintf("%s.lineblocs.com", $this->name);
  }

  public function toArrayWithRoles(User $user) {
        $array = $this->toArray();
        $workspaceUser = WorkspaceUser::where('user_id', '=', $user->id)->where('workspace_id', '=', $this->id)->first();
        $array['user_info'] = $workspaceUser->toArray();
      return $array;
  }
  public function provisionURL() {
    return sprintf("%s.prv.lineblocs.com", $this->name);
  }
  public function sipURL() {
    return sprintf("%s.lineblocs.com", $this->name);
  }
  public function getPlanInfo() {
    $plans = \Config::get("service_plans");
    return $plans[ $this->plan ];
  }
  public static function asSelect() {
    $items = Workspace::all();
    $results = [];
    foreach ( $items as $item_db ){
      $results[$item_db->id] = $item_db->name;
    }
    return $results;
  }

      

}


