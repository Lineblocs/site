<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkspaceUser extends PublicResource {
  protected $dates = ['created_at', 'updated_at'];
  public static $publicPrefix = "wu";
  protected $guarded  = array('id');
  protected $table = "workspaces_users";
  protected $casts = [
      'manage_users' => 'bool',
      'manage_extensions' => 'bool',
      'create_extension' => 'bool',
      'manage_billing' => 'bool',
      'manage_workspace' => 'bool',
      'manage_dids' => 'bool',
      'create_did' => 'bool',
      'manage_calls' => 'bool',
      'manage_recordings' => 'bool',
      'manage_blocked_numbers' => 'bool',
      'manage_ip_whitelist' => 'bool',
      'manage_verified_caller_ids' => 'bool',
      'create_flow' => 'bool',
      'manage_flows' => 'bool',
      'create_function' => 'bool',
      'manage_functions' => 'bool',
      'manage_params' => 'bool',
      'manage_extension_codes' => 'bool',
      'manage_ports' => 'bool',
      'create_phone' => 'bool',
      'manage_phones' => 'bool',
        'create_phonegroup' => 'bool',
      'manage_phonegroups' => 'bool',
      'create_phoneglobalsetting' => 'bool',
      'manage_phoneglobalsettings' => 'bool',
      'create_phoneindividualsetting' => 'bool',
      'manage_phoneindividualsettings' => 'bool',
      'manage_billing' => 'bool',
      'manage_byo_carriers' => 'bool',
      'create_byo_carrier' => 'bool',
      'manage_byo_did_numbers' => 'bool',
      'create_byo_did_number' => 'bool',
      'manage_trunks' => 'bool',
      'create_trunks' => 'bool',



  ];
  public static $permissions = [
      'manage_users',
      'manage_extensions',
      'create_extension',
      'manage_billing',
      'manage_workspace',
      'manage_dids',
      'create_did',
      'manage_calls',
      'manage_recordings',
      'manage_blocked_numbers',
      'manage_ip_whitelist',
      'manage_verified_caller_ids',
      'create_flow',
      'manage_flows',
      'create_function',
      'manage_functions',
      'manage_params',
      'manage_extension_codes',
      'manage_ports',
      'create_phone',
      'manage_phones',
      'create_phonegroup',
      'manage_phonegroups',
      'create_phoneglobalsetting',
      'manage_phoneglobalsettings',
      'create_phoneindividualsetting',
      'manage_phoneindividualsettings',
      'manage_billing',
      'manage_byo_carriers',
      'create_byo_carrier',
      'manage_byo_did_numbers',
      'create_byo_did_number',
      'manage_trunks',
      'create_trunks'

  ];
  public static function createSuperAdmin($workspace, $user, $extras=[]) {
      $attrs = [];
      foreach (WorkspaceUser::$permissions as $perm) {
        $attrs[$perm] = TRUE;
      }
      $attrs['user_id'] = $user->id;
      $attrs['workspace_id'] = $workspace->id;
      $attrs = array_merge( $attrs, $extras );
      return WorkspaceUser::create($attrs);
  }
  public static function updateSuperAdmin($workspace, $user) {
      $user = WorkspaceUser::where('user_id', $user->id)->where('workspace_id', $workspace->id)->firstOrFail();
      $attrs = [];
      foreach (WorkspaceUser::$permissions as $perm) {
        $attrs[$perm] = TRUE;
      }
      $user->update( $attrs );
  }
  public function createJoinHash() {
    $hash = bin2hex(random_bytes(16));
    $this->update([
      'hash' => $hash
    ]);
    return $hash;
  }


}


