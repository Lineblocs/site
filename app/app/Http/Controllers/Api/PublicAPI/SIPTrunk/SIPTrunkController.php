<?php

namespace App\Http\Controllers\Api\PublicAPI\SIPTrunk;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\SIPTrunk;
use \App\Transformers\TrunkTransformer;
use \App\NumberService\SIPConfigService;
use \App\Helpers\SIPRouterHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use \DB;
use Mail;
use Config;


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
        unset( $data['orig_endpoints'] );
        unset( $data['orig_settings'] );
        unset( $data['term_acls'] );
        unset( $data['term_creds'] );
        unset( $data['term_settings'] );
        $trunk  = SIPTrunk::create( $data );
        $this->patchResource( $trunk, $orig_endpoints, $orig_endpoints_db, "\\App\\SIPTrunkOriginationEndpoint" );
        $this->patchResource( $trunk, $term_acls, $term_acls_db, "\\App\\SIPTrunkTerminationAcl" );
        $this->patchResource( $trunk, $term_creds, $term_creds_db, "\\App\\SIPTrunkTerminationCredential" );

        return $this->response->array($trunk->toArray())->withHeader('X-Trunk-ID', $trunk->public_id);
    }

    private function patchResource( $trunk, $trunk_resource_before, $trunk_resource_db, $trunk_resource_cls)
    {
        foreach ( $trunk_resource_db as $item ) {
            $found = FALSE;
            foreach ( $trunk_resource as $item2 ) {
                if ( isset( $item2['id'] ) && $item['id'] == $item2['id'] ) {
                    $found = TRUE;
                }
            }
            if ( !$found ) {
                $item->delete();
            }
        }
        foreach ( $trunk_resource as $item ) {
            $found = FALSE;
            foreach ( $trunk_resource_db as $item2 ) {
                if ( isset( $item['id'] ) && $item['id'] == $item2['id'] ) {
                    $found = $item2;
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
        unset( $data['orig_endpoints'] );
        unset( $data['orig_settings'] );
        unset( $data['term_acls'] );
        unset( $data['term_creds'] );
        unset( $data['term_settings'] );
        $trunk->update($data);
        $this->patchResource( $trunk, $orig_endpoints, $orig_endpoints_db, "\\App\\SIPTrunkOriginationEndpoint" );
        $this->patchResource( $trunk, $term_acls, $term_acls_db, "\\App\\SIPTrunkTerminationAcl" );
        $this->patchResource( $trunk, $term_creds, $term_creds_db, "\\App\\SIPTrunkTerminationCredential" );
    }
    public function trunkData(Request $request, $trunkId)
    {
        $trunk = SIPTrunk::where('public_id', '=', $trunkId)->firstOrFail();
        if (!$this->hasPermissions($request, $trunk, 'manage_trunks')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($trunk->toArray());
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
        $trunk = SIPTrunk::findOrFail($trunkId);
        if (!$this->hasPermissions($request, $trunk, 'manage_trunks')) {
            return $this->response->errorForbidden();
        }
        $trunk->delete();
        return $this->response->noContent();
    }
}

