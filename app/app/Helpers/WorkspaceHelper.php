<?php
namespace App\Helpers;
use Config;
use DB;
use Log;

use App\User;
use App\Workspace;
use App\WorkspaceUser;
use App\WorkspaceRoutingACL;
use App\SIPRoutingACL;
use App\ServicePlan;
use App\UsageTrigger;

final class WorkspaceHelper {
  public static function getMyWorkspaces($user) {
    $workspaces =  WorkspaceUser::select(DB::raw("workspaces_users.*"));
    $workspaces->leftJoin('workspaces', 'workspaces.id', '=', 'workspaces_users.workspace_id');
    $workspaces->where('workspaces_users.user_id', '=', $user->id);
    $results = $workspaces->get();
    return $workspaces;
  }
   public static function canPerformAction($user, $workspace, $action) {
    $settings =  WorkspaceUser::where('user_id', '=', $user->id)->where('workspace_id', '=', $workspace->id)->first();
    switch ($action) {
      case 'manage_users':
        return $settings->manage_users;
      break;
      case 'manage_extensions':
        return $settings->manage_extensions;
      break;
case 'create_extension':
        return $settings->create_extension;
      break;
case 'manage_billing':
        return $settings->manage_billing;
      break;
case 'manage_dids':
        return $settings->manage_dids;
      break;
case 'create_did':
        return $settings->create_did;
      break;
case 'manage_workspace':
        return $settings->manage_workspace;
      break;
case 'create_function':
        return $settings->create_function;
      break;
case 'manage_function':
        return $settings->manage_function;
      break;
case 'manage_params':
        return $settings->manage_params;
      break;
case 'manage_extension_codes':
        return $settings->manage_extension_codes;
      break;
case 'manage_ports':
        return $settings->manage_ports;
      break;
case 'manage_phones':
        return $settings->manage_phones;
      break;
case 'create_phone':
        return $settings->create_phone;
      break;
case 'manage_phonegroups':
        return $settings->manage_phonesgroups;
      break;
case 'create_phonegroup':
        return $settings->create_phonegroup;
      break;
case 'manage_phoneglobalsetting':
        return $settings->manage_phoneglobalsettings;
      break;
case 'create_phoneglobalsetting':
        return $settings->create_phoneglobalsetting;
      break;
case 'manage_phoneindividualsetting':
        return $settings->manage_phoneindividualsettings;
      break;
case 'create_phoneindividualsetting':
        return $settings->create_phoneindividualsetting;
      break;
case 'manage_byo_carriers':
        return $settings->manage_byo_carriers;
      break;
case 'create_byo_carrier':
        return $settings->create_byo_carrier;
      break;
case 'manage_byo_did_numbers':
        return $settings->manage_byo_did_numbers;
      break;
case 'create_byo_did_number':
        return $settings->create_byo_did_number;
      break;
case 'manage_trunks':
        return $settings->manage_trunks;
      break;
case 'create_trunks':
        return $settings->create_trunks;
      break;








      
    }
  }

  public static function getLimits($user, $plan=NULL) {
    $workspace = \App\Workspace::where('creator_id', $user->id)->first();

    if ( $workspace ) {
      // FIXME: need to add better handling for database I/O
      if (!empty($plan)) {
          return $plan;
      }

      Log::info(sprintf("looking up service plan key_name = %s", $workspace->plan));
      $plan = ServicePlan::where('key_name', $workspace->plan)->firstOrFail()->toArray();
      return $plan;
    } else {
      return [
        'call_duration' => 'N/A',
        'recording_space' => 'N/A',
      ];
    }
  }

  public static function getACLs($workspace)
  {
      $acls = SIPRoutingACL::select(array(
          'sip_routing_acl.iso',
          'sip_routing_acl.name',
          'sip_routing_acl.risk_level',
          DB::raw('sip_routing_acl.enabled AS preset_acl_enabled'),
          DB::raw('sip_routing_acl.id AS routing_acl_id'),
          //DB::raw('workspace_routing_acl.id AS workspace_acl_id'),
          //DB::raw('workspace_routing_acl.enabled AS enabled'),
      ));
      $data = $acls->get()->toArray(); 
      foreach ( $data as $cnt => $row ) {
        $acl = WorkspaceRoutingACL::where('routing_acl_id',$row['routing_acl_id'])->first();
        if ( $acl ) {
          $data[$cnt]['workspace_acl_id'] = $acl->id;
          $data[$cnt]['enabled'] = $acl->enabled;
        }
      }
      return $data;
  }
}
