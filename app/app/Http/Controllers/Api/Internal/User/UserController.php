<?php

namespace App\Http\Controllers\Api\Internal\User;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Workspace;
use \App\WorkspaceParam;
use \App\DIDNumber;
use \App\IpWhitelist;
use \App\MacroFunction;
use \App\BlockedNumber;
use \App\Extension;
use \App\Helpers\MainHelper;
use \App\SIPProvider;
use \App\SIPProviderHost;
use \App\BYOCarrier;
use \App\BYOCarrierIP;
use \App\BYODIDNumber;
use \App\MediaServer;
use \Config;
use \DB;
use \Log;
use \Response;


class UserController extends ApiAuthController {
  private function userByDomain($domain) {
      $splitted = explode(".", $domain);
      $container = $splitted[0];
      $workspace = Workspace::where('name', $container)->firstOrFail();
      $user = User::findOrFail($workspace->creator_id);
      $data = $user->toArray();
      $data['outbound_macro_id'] = $workspace->outbound_macro_id;
      $data['workspace_name'] = $workspace->name;
      $data['workspace_id'] = $workspace->id;
      $data['workspace_domain'] = $workspace->makeDomainName();

      $data['workspace_params'] = MainHelper::makeParamsArray(WorkspaceParam::where('workspace_id', $data['workspace']['id'])->get()->toArray());
      return $data;
  }
  private function doVerifyCaller($workspaceId, $number)
  {
      $check = Config::get("api_routing.caller_id_spoof_check");
      if ($check) {
        $isValid = FALSE;
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $numberProto = $phoneUtil->parse($number, "US");
            if ( !  $phoneUtil->isValidNumber($numberProto) ) {
              $isValid = FALSE;
            }
            $number =$phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::E164);
            $count = DIDNumber::where('workspace_id', '=', $workspaceId)->where('number', '=', $number)->count();
            if ($count > 0) {
              $isValid = TRUE;
            }
            return $isValid;
        } catch (\libphonenumber\NumberParseException $e) {
            return $isValid;
        }
      }
      return TRUE;
    }
    public function verifyCaller(Request $request)
    {
      return $this->response->array(['valid' => $this->doVerifyCaller($request->get("workspaceId"), $request->get("number"))]);
    }
  public function verifyCallerByDomain(Request $request)
    {
      $workspace = MainHelper::workspaceByDomain($request->get("domain"));
      $valid = $this->doVerifyCaller($workspace->id, $request->get("number"));
      if (!$valid) {
        return $this->response->errorBadRequest();
      }
      return $this->response->noContent();
    }

    public function getUserByDomain(Request $request)
    {
      $domain = $request->get("domain");
      $data = $this->userByDomain($domain);
      return $this->response->array($data);
    }
    public function getWorkspaceMacros(Request $request)
    {
      $workspace= $request->get("workspace");
      \Log::info("getting macros for workspace: " . $workspace);
      $macros = MacroFunction::where('workspace_id', '=', $workspace)->get()->toArray();
      return $this->response->array($macros);
    }

    public function getDIDNumberData(Request $request)

    {
      $debug = Config::get("app.debug");
      $number = $request->get("number");

      Log::info(sprintf("looking up number %s",$number));
      $workspace = Workspace::select(DB::raw("flows.workspace_id, flows.flow_json, did_numbers.number, workspaces.name, workspaces.name AS workspace_name, 
        users.plan,
        workspaces.outbound_macro_id,
        workspaces.byo_enabled,
        workspaces.creator_id,
        workspaces.id AS workspace_id,
        workspaces.api_token,
        workspaces.api_secret
        "));

      $workspace->join('did_numbers', 'workspaces.id', '=', 'did_numbers.workspace_id');
      $workspace->join('flows', 'flows.id', '=', 'did_numbers.flow_id');
      $workspace->join('users', 'users.id', '=', 'workspaces.creator_id');
      $workspace->where('did_numbers.api_number', '=', $number);

      // DID numbers first
      $workspace= $workspace->first();

      if ($workspace) {

        $array = $workspace->toArray();
        $array['workspace'] = $workspace->toArray();
        $array['workspace_params'] = MainHelper::makeParamsArray(WorkspaceParam::where('workspace_id', $array['workspace_id'])->get()->toArray());
        $user = User::findOrFail($workspace['creator_id'] );
        $array['free_trial_status'] = $user->checkFreeTrialStatus();
        $array['is_byo'] = FALSE;

        return $this->response->array($array);
      }


      // check BYO DID next
      $workspace = Workspace::select(DB::raw("flows.workspace_id, flows.flow_json, byo_did_numbers.number, workspaces.name, workspaces.name AS workspace_name, 
        users.plan,
        workspaces.outbound_macro_id,
        workspaces.byo_enabled,
        workspaces.creator_id,
        workspaces.id AS workspace_id,
        workspaces.api_token,
        workspaces.api_secret
        "));


      $workspace->Join('byo_did_numbers', 'workspaces.id', '=', 'byo_did_numbers.workspace_id');
      $workspace->join('flows', 'flows.id', '=', 'byo_did_numbers.flow_id');
      $workspace->join('users', 'users.id', '=', 'workspaces.creator_id');
      $workspace->where('byo_did_numbers.number', '=', $number);
      $workspace= $workspace->first();

      if ($workspace) {

        $array = $workspace->toArray();
        $array['workspace'] = $workspace->toArray();
        $array['workspace_params'] = MainHelper::makeParamsArray(WorkspaceParam::where('workspace_id', $array['workspace_id'])->get()->toArray());
        $user = User::findOrFail($workspace['creator_id'] );
        $array['free_trial_status'] = $user->checkFreeTrialStatus();
        $array['is_byo'] = TRUE;

        return $this->response->array($array);
      }

      return $this->response->errorNotFound();
    }

    public function getExtensionFlowInfo(Request $request)

    {
      $debug = Config::get("app.debug");
      $extension = $request->get("extension");
      $workspace = $request->get("workspace");
      $number = $request->get("number");
      Log::info(sprintf("looking up number %s",$number));
      $workspace = Workspace::select(DB::raw("flows.workspace_id, flows.flow_json, extensions.username, workspaces.name, workspaces.name AS workspace_name, 
        users.plan,
        workspaces.outbound_macro_id,
        workspaces.creator_id,
        workspaces.id AS workspace_id,
        workspaces.api_token,
        workspaces.api_secret

        "));

      $workspace->join('extensions', 'workspaces.id', '=', 'extensions.workspace_id');
      $workspace->join('flows', 'flows.id', '=', 'extensions.flow_id');
      $workspace->join('users', 'users.id', '=', 'workspaces.creator_id');
      $workspace->where('extensions.username', '=', $extension);
      $workspace= $workspace->firstOrFail(); 
      $array = $workspace->toArray();
      $user = User::findOrFail($workspace['creator_id'] );
      $array['workspace_params'] = MainHelper::makeParamsArray(WorkspaceParam::where('workspace_id', $array['workspace_id'])->get()->toArray());
      $array['free_trial_status'] = $user->checkFreeTrialStatus();
      return $this->response->array($array);
    }

    public function getCodeFlowInfo(Request $request)

    {
      $debug = Config::get("app.debug");
      $code = $request->get("code");
      $workspaceId = $request->get("workspace");
      $number = $request->get("number");
      Log::info(sprintf("looking up number %s",$number));
      $workspace = Workspace::select(DB::raw("flows.workspace_id, flows.flow_json, extension_codes.code, workspaces.name, workspaces.name AS workspace_name, 
        users.plan,
        workspaces.outbound_macro_id,
        workspaces.creator_id,
        workspaces.id AS workspace_id
        "));

      $workspace->join('extension_codes', 'workspaces.id', '=', 'extension_codes.workspace_id');
      $workspace->join('flows', 'flows.id', '=', 'extension_codes.flow_id');
      $workspace->join('users', 'users.id', '=', 'workspaces.creator_id');
      $workspace->where('extension_codes.code', '=', $code);
      $workspace->where('extension_codes.workspace_id', '=', $workspaceId);
      $workspace= $workspace->first();
      if ($workspace) {
        $array = $workspace->toArray();
        $array['workspace_params'] = MainHelper::makeParamsArray(WorkspaceParam::where('workspace_id', $array['workspace_id'])->get()->toArray());
        $user = User::findOrFail($workspace['creator_id'] );
        $array['free_trial_status'] = $user->checkFreeTrialStatus();
        $array['found_code'] = TRUE;
        return $this->response->array($array);
      }
      $array = array('found_code' => FALSE);
        return $this->response->array($array);
    }


    public function ipWhitelistLookup(Request $request) {
      $ip = $request->get("ip");
      $domain = $request->get("domain");
      $user = $this->userByDomain($domain);
      $workspace = MainHelper::workspaceByDomain($domain);
      $ips = IpWhitelist::where('workspace_id', '=', $workspace->id)->get();
      if ($user['ip_whitelist_disabled']) {
        return $this->response->noContent();
      }
      foreach ($ips as $target) {
        $full = sprintf("%s%s", $target['ip'], $target['range']);
        if ( MainHelper::CIDRMatch($ip, $full) ) {
          return $this->response->noContent();
        }
      }
      return $this->response->errorNotFound();
    }
    public function getDIDAssignedIP(Request $request) {
      $did = $request->get("did");
      $workspaceId = $request->get("workspace");
      $number = $request->get("number");
      Log::info(sprintf("looking up number %s",$number));
      //return response("35.183.88.150");
      $workspace = Workspace::select(DB::raw("workspaces.name, workspaces.name AS workspace_name, 
        users.plan,
        users.ip_address,
        users.ip_private,
        workspaces.outbound_macro_id,
        workspaces.creator_id,
        workspaces.id AS workspace_id
        "));

      $workspace->join('did_numbers', 'workspaces.id', '=', 'did_numbers.workspace_id');
      $workspace->join('users', 'users.id', '=', 'workspaces.creator_id');
      $workspace->where('did_numbers.api_number', '=', $did);
      $workspace= $workspace->first();

      if ($workspace) {
          $result = MediaServer::select(array('media_servers.*'));
          $results = $result->get();
          //todo add logic
          foreach ($results as $result) {
            return response($result->private_ip_address);
          }

      }


      // check BYO DID next
      $workspace = Workspace::select(DB::raw("workspaces.name, workspaces.name AS workspace_name, 
        users.plan,
        users.ip_address,
        users.ip_private,
        workspaces.outbound_macro_id,
        workspaces.creator_id,
        workspaces.id AS workspace_id
        "));

      $workspace->join('byo_did_numbers', 'workspaces.id', '=', 'byo_did_numbers.workspace_id');
      $workspace->join('users', 'users.id', '=', 'workspaces.creator_id');
      $workspace->where('byo_did_numbers.number', '=', $did);
      $workspace= $workspace->first();

      if ($workspace) {
          $result = MediaServer::select(array('media_servers.*'));
          $results = $result->get();
          //todo add logic
          foreach ($results as $result) {
            return response($result->private_ip_address);
          }
      }

      return $this->response->errorInternal('no result found..');
    }
    public function getUserAssignedIP(Request $request) {
      $username = $request->get("username");
      $domain = $request->get("domain");
      $workspace = MainHelper::workspaceByDomain($domain);
      $user = User::findOrFail($workspace->creator_id);
      $result = MediaServer::select(array('media_servers.*'));
      $results = $result->get();
      //todo add logic
      foreach ($results as $result) {
        return response($result->private_ip_address);
      }
    }
    private function BYORouteMatches($from, $to, $route) {

      return TRUE;
    }
    public function getPSTNProviderIP(Request $request) {
      $from = $request->get("from");
      $to = $request->get("to");
      $domain = $request->get("domain");
      $ru = $request->get("ru");
      $workspace = MainHelper::workspaceByDomain($domain);
      if ($workspace->byo_enabled) {
        $carriers = BYOCarrier::select(array('byo_carriers.name', 'byo_carriers.ip_address', 'users.ip_private', 'byo_carriers_routes.prefix', 'byo_carriers_routes.prepend', 'byo_carriers_routes.match'));
        $carriers = $carriers->leftJoin('byo_carriers_routes', 'byo_carriers_routes.carrier_id', '=', 'byo_carriers.id');
        $carriers = $carriers->leftJoin('workspaces', 'workspaces.id', '=', 'byo_carriers.workspace_id');
        $carriers = $carriers->leftJoin('users', 'users.id', '=', 'workspaces.creator_id');
        $carriers->where('byo_carriers.workspace_id', $workspace->id);
        $routes = $carriers->get();
        foreach ($routes as $route) {
          if ( $this->BYORouteMatches($from, $to, $route)) {
            $ip = $route->ip_address;
            $changed = $route->prepend . $to;
            return Response::json([
              'ip_addr' => $ip, 
              'did' => $changed
            ]);
          }
        }
        return;
      }
      $providers = SIPProvider::select(array('sip_providers.name', 'sip_providers_hosts.ip_private'));
      $providers = $providers->leftJoin('sip_providers_hosts', 'sip_providers_hosts.provider_id', '=', 'sip_providers.id');
      $providers->where('sip_providers.type_of_provider', 'outbound');
      $provider = $providers->first();
      $providerIp = $provider->ip_address;
      //return response($providerIp);
      return Response::json([
              'ip_addr' => $providerIp,
              'did' => $from
            ]);

    }
    public function addPSTNProviderTechPrefix(Request $request) {

    }

    public function getDIDAcceptOption(Request $request) {
      $didArg = $request->get("did");
      $did = DIDNumber::where('api_number', $didArg)->first();
      if ($did) {
        $did = DIDNumber::where('api_number', $didArg)->first();
        return response($did->did_action);
      }
      $did = BYODIDNumber::where('number', $didArg)->first();
      if ($did) {
        return response('accept-call');
      }
       return $this->response->errorNotFound('no results found..');
    }
    public function getCallerIdToUse(Request $request) {
      $domain = $request->get("domain");
      $workspace = MainHelper::workspaceByDomain($domain);
      $extension = $request->get("extension");
      $extensionObj = Extension::where('workspace_id', $workspace->id) ->where('username', $extension)->firstOrFail();
      return $this->response->array(['caller_id' => $extensionObj->caller_id]);
    }

    private function finishValidation($number, $did /** did number or byo did **/) {
      $region= "US";
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $numberProto = $phoneUtil->parse($number, $region);
            if ( !  $phoneUtil->isValidNumber($numberProto) ) {
            return $this->response->errorInternal(  'Invalid number'); 
            }
            $number =$phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::E164);
            $check1 = BlockedNumber::where('workspace_id', $did->workspace_id)->where('number', $number)->first();
            if ($check1) {
              return $this->response->errorInternal();
            }
            $number = str_replace("+", "", $number);
            $check2 = BlockedNumber::where('workspace_id', $did->workspace_id)->where('number', $number)->first();
            if ($check2) {
              return $this->response->errorInternal();
            }
            // remove country code
            $number = preg_replace("/^1/", "", $number);
            $check3 = BlockedNumber::where('workspace_id', $did->workspace_id)->where('number', $number)->first();
            if ($check3) {
              return $this->response->errorInternal();
            }

            return $this->response->noContent();
        } catch (\libphonenumber\NumberParseException $e) {
        
            return $this->response->errorInternal( 'lib phone number error');
        }

    }
    public function incomingPSTNValidation(Request $request) {
      $number = $request->get("number");
      $sourceIp = $request->get("source");
      $didArg = $request->get("did");
      //$region = $request->get("region");
      \Log::info("blocked check number is: " . $didArg);
      $did = DIDNumber::where('api_number', $didArg)->first();
      if ($did) {
          $result = $this->checkPSTNIPWhitelist($did, $sourceIp);
          if (!$result) {
            return $this->response->errorInternal( 'Lineblocs source IP not whitelisted.');
          }
          return $this->finishValidation($number, $did);
      }
      $did = BYODIDNumber::where('number', $didArg)->first();
      if ($did) {
        \Log::info("got BYO DID..");
            $result = $this->checkBYOPSTNIPWhitelist($did, $sourceIp);
          if (!$result) {
            return $this->response->errorInternal( 'BYO source IP not whitelisted.');
          }

          return $this->finishValidation($number, $did);
      }
      return $this->response->errorInternal('no results found..');

    }

    public function incomingMediaServerValidation(Request $request) {
      $number = $request->get("number");
      $sourceIp = $request->get("source");
      $didArg = $request->get("did");
      $result = MediaServer::select(array('media_servers.*'));
      $results = $result->get();
      foreach ($results as $result) {
         $range = $result->ip_address . $result->ip_address_range;
      
        if ( MainHelper::CIDRMatch($sourceIp, $range) ) {
          return $this->response->noContent();
        }
      }
      return $this->response->errorInternal();
    }
    public function checkPSTNIPWhitelist($did, $sourceIp) {
      $result = SIPProvider::select(array('sip_providers.*', 'sip_providers_whitelist_ips.ip_address', 'sip_providers_whitelist_ips.range'));
      $result->join('sip_providers_whitelist_ips', 'sip_providers_whitelist_ips.provider_id',  '=', 'sip_providers.id');
      $results = $result->get();
      foreach ($results as $result) {
        $range = $result->ip_address . $result->range;
        if ( MainHelper::CIDRMatch($sourceIp, $range) ) {
          return TRUE;
        }
      }
      return FALSE;
  }
    public function checkBYOPSTNIPWhitelist($did, $sourceIp) {
        $result = BYOCarrier::select(array('byo_carriers.*', 'byo_carriers_ips.ip', 'byo_carriers_ips.range'));
        $result->join('byo_carriers_ips', 'byo_carriers_ips.carrier_id', '=', 'byo_carriers.id');
        $result->where('byo_carriers.workspace_id', $did->workspace_id);
        $results = $result->get();
        foreach ($results as $result) {
          $range = $result->ip . $result->range;
          if ( MainHelper::CIDRMatch($sourceIp, $range) ) {
            return TRUE;
          }
        }
        return FALSE;
    }

}

