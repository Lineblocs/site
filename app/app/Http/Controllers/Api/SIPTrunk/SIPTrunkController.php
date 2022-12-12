<?php

namespace App\Http\Controllers\Api\SIPTrunk;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\SIPTrunk;
use \App\SIPTrunkOrigination;
use \App\SIPTrunkOriginationEndpoint;
use \App\SIPTrunkTermination;
use \App\SIPTrunkTerminationAcl;
use \App\SIPTrunkTerminationCredential;
use \App\DIDNumber;
use \App\Transformers\TrunkTransformer;
use \App\NumberService\SIPConfigService;
use \App\Helpers\SIPRouterHelper;
use \App\Helpers\DNSHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use \DB;
use Mail;
use Config;
use Exception;
class DIDNumberAllocatedException extends Exception {
    function __construct( $did_number, $msg ) {
        $this->did_number = $did_number;
        parent::__construct( $msg );
    }
    public function getDIDNumber() {
        return $this->did_number;

    }
}


class SIPTrunkController extends ApiAuthController {
    public function saveTrunk(Request $request)
    {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $orig_endpoints=  [];
        if ( array_key_exists('orig_endpoints',$data ) ) {
            $orig_endpoints=  $data['orig_endpoints'];
        }
        $orig_settings =  $data['orig_settings'];

        $term_acls=  [];
        if ( array_key_exists('term_acls',$data ) ) {
            $term_acls=  $data['term_acls'];
        }
        $term_creds=  [];
        if ( array_key_exists('term_creds',$data ) ) {
            $term_creds=  $data['term_creds'];
        }
        $term_settings =  $data['term_settings'];
        $did_numbers = [];
        if ( array_key_exists('did_numbers',$data ) ) {
            $did_numbers=  $data['did_numbers'];
            unset( $data['did_numbers'] );
        }
        unset( $data['orig_endpoints'] );
        unset( $data['orig_settings'] );
        unset( $data['term_acls'] );
        unset( $data['term_creds'] );
        unset( $data['term_settings'] );
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);

        // check if trunk exists with same name

        $trunkCount  = SIPTrunk::where('name', $data['name'])->count();
        if ( $trunkCount  > 0 ) {
            return $this->response->errorInternal(sprintf('trunk exists with name %s', $data['name']));
        }
        $trunk  = SIPTrunk::create( [
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'name' => $data['name'],
            'record' => $data['record']
        ]);
        $orig_data = array_merge( $orig_settings, [
            'trunk_id' => $trunk->id
        ]);
        $orig_settings_db  = SIPTrunkOrigination::create( $orig_data );
        $term_data = [
            'trunk_id' => $trunk->id,
            'sip_addr' => $term_settings['sip_addr']
        ];
        $term_db = SIPTrunkTermination::create($term_data);
        $orig_endpoints_db = SIPTrunkOriginationEndpoint::where('trunk_id', $trunk->id)->get();
        $term_acls_db = SIPTrunkTerminationAcl::where('trunk_id', $trunk->id)->get();
        $term_creds_db = SIPTrunkTerminationCredential::where('trunk_id', $trunk->id)->get();
        try {
            $this->integrateTrunkWithDIDNumbers($trunk, $workspace, $did_numbers);
        } catch ( DIDNumberAllocatedException $ex ) {
            $did_number = $ex->getDIDNumber();
            return $this->response->errorInternal(sprintf('cant associate DID %s with trunk as it is already reserved. please unlink the DID before trying again..', $did_number['number']));
        }



        $this->updateOriginationEndpoints( $trunk, $orig_endpoints, $orig_endpoints_db );
        $this->syncTrunkWithRouter( $user, $trunk, $term_settings );
        $this->patchResource( $trunk, $term_acls, $term_acls_db, "\\App\\SIPTrunkTerminationAcl" );
        $this->patchResource( $trunk, $term_creds, $term_creds_db, "\\App\\SIPTrunkTerminationCredential" );
        return $this->response->array($trunk->toArray())->withHeader('X-Trunk-ID', $trunk->public_id);
    }

    private function syncTrunkWithRouter( $user, $trunk, $term_settings) {
          // entry to database
         $fullDomain = MainHelper::createSIPTrunkTerminationURI( $term_settings['sip_addr'] ).".".Config::get("app.sip_base_domain");;
         SIPRouterHelper::addDomain($user,$fullDomain);
        // update DNS
          $result = DNSHelper::refreshIPs();
    }
    private function updateOriginationEndpoints( $trunk, $orig_endpoints, $orig_endpoints_db ) {

        // lookup IP addresses
        // try to get all address types (v4 and v6)
        for ($i = 0; $i != count($orig_endpoints); $i ++ ) {
            $item = $orig_endpoints[$i];
            $ipv4 = gethostbyname($item['sip_uri']);
            // setting IP info...
            $orig_endpoints[$i]['ipv4'] = $ipv4;
            $orig_endpoints[$i]['ipv6'] = $ipv4;
        }
        $this->patchResource( $trunk, $orig_endpoints, $orig_endpoints_db, "\\App\\SIPTrunkOriginationEndpoint" );

    }

    private function patchResource( $trunk, $trunk_resource_before, $trunk_resource_db, $trunk_resource_cls, $alt_key=NULL)
    {
        foreach ( $trunk_resource_db as $item ) {
            $found = FALSE;
            foreach ( $trunk_resource_before as $item2 ) {
                if ( !$alt_key) {
                    if ( (isset( $item2['id'] ) && $item['id'] == $item2['id'])
                    || 
                         isset( $item2[$alt_key] ) && $item[$alt_key] == $item2[$alt_key]) {
                        $found = TRUE;
                    }
                } else {

                    if ( isset( $item2['id'] ) && $item['id'] == $item2['id'] ) {
                        $found = TRUE;
                    }
                }
            }
            if ( !$found ) {
                $item->delete();
            }
        }
        foreach ( $trunk_resource_before as $item ) {
            $found = FALSE;
            foreach ( $trunk_resource_db as $item2 ) {
                if ( !$alt_key) {
                    if ( isset( $item['id'] ) && $item['id'] == $item2['id'] ) {

                        $found = $item2;
                    }
                } else {
                    if ( isset( $item['id'] ) && $item['id'] == $item2['id'] 
                            || 
                            isset( $item[$alt_key] ) && $item[$alt_key] == $item2[$alt_key] ) {
                        $found = $item2;
                    }
                }
            }
            if ( $found ) {
                $found->update( $item );
            } else {
                $trunk_resource_cls::create( array_merge([
                    'trunk_id' => $trunk->id
                ], $item ) );
            }
        }
    }

    public function updateTrunk(Request $request, $trunkId)
    {
         $trunk =   SIPTrunk::where( 'public_id', $trunkId )->firstOrFail();
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $orig_endpoints=  [];
        $did_numbers = [];
        if ( array_key_exists('did_numbers',$data ) ) {
            $did_numbers=  $data['did_numbers'];
            unset( $data['did_numbers'] );
        }
        if ( array_key_exists('orig_endpoints',$data ) ) {
            $orig_endpoints=  $data['orig_endpoints'];
        }
        $orig_settings =  $data['orig_settings'];

        $term_acls=  [];
        if ( array_key_exists('term_acls',$data ) ) {
            $term_acls=  $data['term_acls'];
        }
        $term_creds=  [];
        if ( array_key_exists('term_creds',$data ) ) {
            $term_creds=  $data['term_creds'];
        }
        $term_settings =  $data['term_settings'];
        unset( $data['orig_endpoints'] );
        unset( $data['orig_settings'] );
        unset( $data['term_acls'] );
        unset( $data['term_creds'] );
        unset( $data['term_settings'] );
        $trunk->update([
            'name' => $data['name'],
            'record' => $data['record']
        ]);

        $orig_data = array_merge( $orig_settings, [
            'trunk_id' => $trunk->id
        ]);
        $orig_settings_db  = SIPTrunkOrigination::where('trunk_id', $trunk->id)->firstOrFail();
        $orig_settings_db->update($orig_settings);

        $term_data = [
            'sip_addr' => $term_settings['sip_addr']
        ];
        $term_db = SIPTrunkTermination::where('trunk_id', $trunk->id)->firstOrFail();
        $term_db->update($term_data);

        try {
            $this->integrateTrunkWithDIDNumbers($trunk, $workspace, $did_numbers);
        } catch ( DIDNumberAllocatedException $ex ) {
            $did_number = $ex->getDIDNumber();
            return $this->response->errorInternal(sprintf('cant associate DID %s with trunk as it is already reserved. please unlink the DID before trying again..', $did_number['number']));
        }
        $orig_endpoints_db = SIPTrunkOriginationEndpoint::where('trunk_id', $trunk->id)->get();
        $term_acls_db = SIPTrunkTerminationAcl::where('trunk_id', $trunk->id)->get();
        $term_creds_db = SIPTrunkTerminationCredential::where('trunk_id', $trunk->id)->get();
        $this->updateOriginationEndpoints( $trunk, $orig_endpoints, $orig_endpoints_db );
        $this->patchResource( $trunk, $term_acls, $term_acls_db, "\\App\\SIPTrunkTerminationAcl" );
        $this->patchResource( $trunk, $term_creds, $term_creds_db, "\\App\\SIPTrunkTerminationCredential" );
    }

    private function integrateTrunkWithDIDNumbers($trunk, $workspace, $did_numbers) {
        $did_numbers_db = DIDNumber::where('trunk_id', $trunk->id)->get();
        foreach ( $did_numbers as $did_input ) {
            $did_id = $did_input['public_id'];
            $did = DIDNumber::where('public_id', $did_id)->where('workspace_id', $workspace->id)->first();
            if (!$this->checkIfDIDAvailable( $did ) ) {
                throw new DIDNumberAllocatedException( $did, 'cant associate DID %s with trunk as it is already reserved. please unlink the DID before trying again..', $did['number'] );
            }
            if ( $did->trunk_id != $trunk->id ) {
                $did->update([
                    'trunk_id' => $trunk->id
                ]);
            }
        }
        foreach ( $did_numbers_db  as $item ) {
            $found = FALSE;
            foreach ( $did_numbers as $did_input ) {

                if ( $did_input['public_id'] == $item->public_id ) {
                    $found = TRUE;
                }
            }
            if ( !$found ) {

                $item->update([
                    'trunk_id' => NULL
                ]);
            }
        }
    }
    public function checkIfDIDAvailable( $did_db ) { 
        if ( !empty( $did_db->flow_id ) ) {
            return FALSE;
        }
        return TRUE;
    }
    public function trunkData(Request $request, $trunkId)
    {
        $trunk = SIPTrunk::where('public_id', '=', $trunkId)->firstOrFail();
        if (!$this->hasPermissions($request, $trunk, 'manage_trunks')) {
            return $this->response->errorForbidden();
        }

        \Log::info(sprintf('loading trunk data for trunk ID = %s', $trunk->id));

        $orig_endpoints_db = SIPTrunkOriginationEndpoint::where('trunk_id', $trunk->id)->get();
        $orig_settings_db = SIPTrunkOrigination::where('trunk_id', $trunk->id)->first();
        $term_settings_db = SIPTrunkTermination::where('trunk_id', $trunk->id)->first();
        $term_acls_db = SIPTrunkTerminationAcl::where('trunk_id', $trunk->id)->get();
        $term_creds_db = SIPTrunkTerminationCredential::where('trunk_id', $trunk->id)->get();


        $data = $trunk->toArray();
        $data['orig_endpoints'] = $orig_endpoints_db->toArray();
        $data['orig_settings'] = $orig_settings_db->toArray();
        $data['term_settings'] = $term_settings_db->toArray();
        return $this->response->array($data);
    }
    public function listTrunks(Request $request)
    {
        $all = $request->get("all");
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $trunks = SIPTrunk::where('workspace_id', $workspace->id);
        if ($all) {
          return $this->response->collection($trunks->get(), new TrunkTransformer);
        }

        MainHelper::addSearch($request, $trunks, ['name']);
        return $this->response->paginator($trunks->paginate($paginate), new TrunkTransformer);
    }

    public function deleteTrunk(Request $request, $trunkId)
    {
        $data = $request->json()->all();
        $trunk = SIPTrunk::where('public_id', $trunkId)->firstOrFail();
        $user = $this->getUser($request);
        if (!$this->hasPermissions($request, $trunk, 'manage_trunks')) {
            return $this->response->errorForbidden();
        }
        $term_settings = SIPTrunkTermination::where('trunk_id', $trunk->id)->firstOrFail();
        $fullDomain = MainHelper::createSIPTrunkTerminationURI( $term_settings->sip_addr ).".".Config::get("app.sip_base_domain");;
        SIPRouterHelper::removeDomain($user, $fullDomain);

        $trunk->delete();
        return $this->response->noContent();
    }
}

