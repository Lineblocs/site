<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use \App\SIPTrunk;
use \App\SIPTrunkOrigination;
use \App\SIPTrunkOriginationEndpoint;
use \App\SIPTrunkTermination;
use \App\SIPTrunkTerminationAcl;
use \App\SIPTrunkTerminationCredential;


use App\Workspace;
use App\PortNumber;
use App\DIDNumber;
use App\Http\Requests\Admin\SIPTrunkRequest;
use App\Helpers\MainHelper;
use App\SIPTrunkHost;
use App\SIPTrunkRate;
use App\SIPTrunkWhitelistIp;
use App\CallRate;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SIPTrunkController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'trunk');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.siptrunk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $workspaces = Workspace::asSelect();
        return view('admin.siptrunk.create_edit', compact('workspaces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SIPTrunkRequest $request)
    {

        $trunk = new SIPTrunk ($request->all());
        $trunk->save();
        SIPTrunkOrigination::create([
            'trunk_id' => $trunk->id
        ]);
        SIPTrunkTermination::create([
            'trunk_id' => $trunk->id
        ]);
        header("X-Goto-URL: /admin/trunk/" . $trunk->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SIPTrunk $trunk)
    {
        $workspaces = Workspace::asSelect();
        $orig_settings = SIPTrunkOrigination::where('trunk_id', '=', $trunk->id)->first();
        $orig_endpoints = SIPTrunkOriginationEndpoint::where('trunk_id', '=', $trunk->id)->get();
        $term_settings = SIPTrunkTermination::where('trunk_id', '=', $trunk->id)->first();
        $term_acls = SIPTrunkTerminationAcl::where('trunk_id', '=', $trunk->id)->get();
        $term_creds = SIPTrunkTerminationCredential::where('trunk_id', '=', $trunk->id)->get();
        $dids= DIDNumber::where('trunk_id', '=', $trunk->id)->get();
        return view('admin.siptrunk.create_edit', compact('trunk', 'orig_settings', 'orig_endpoints', 'term_settings', 'term_acls', 'term_creds', 'workspaces', 'dids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SIPTrunkRequest $request, SIPTrunk $trunk)
    {
        $data = $request->all();
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
        $orig = SIPTrunkOrigination::where('trunk_id', '=', $trunk->id)->first();
        $orig->update( $orig_settings );

        $orig_endpoints_db = SIPTrunkOriginationEndpoint::where('trunk_id', '=', $trunk->id)->get();
        $this->patchResource( $trunk, $orig_endpoints, $orig_endpoints_db, "\\App\\SIPTrunkOriginationEndpoint" );
        $term_db = SIPTrunkTermination::where('trunk_id', '=', $trunk->id)->first();
        $term_acls_db = SIPTrunkTerminationAcl::where('trunk_id', '=', $trunk->id)->get();
        $term_creds_db = SIPTrunkTerminationCredential::where('trunk_id', '=', $trunk->id)->get();
        $term_db->update( $term_settings );
        $this->patchResource( $trunk, $term_acls, $term_acls_db, "\\App\\SIPTrunkTerminationAcl" );
        $this->patchResource( $trunk, $term_creds, $term_creds_db, "\\App\\SIPTrunkTerminationCredential" );

        header("X-Goto-URL: /admin/trunk/" . $trunk->id . "/edit");
    }

    private function transformFormInput( $input ) { // multi dimensional array
        $keys = array_keys( $input );
        $results = [];
        if ( count( $keys ) == 0 ){
            return $results;
        }
        $length = count( $input[$keys[0]] );
        $results = [];
        for ($i=0;$i!=$length;$i++) {
            $new_item = [];
            foreach ( $keys as $key ) {
                $new_item[$key] = $input[$key][$i];
            }
            $results[] = $new_item;
        }
        return $results;
    }
    private function patchResource( $trunk, $trunk_resource_before, $trunk_resource_db, $trunk_resource_cls)
    {
        $trunk_resource = $this->transformFormInput($trunk_resource_before);
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
                echo var_dump($item);
                echo var_dump($trunk->id);
                $trunk_resource_cls::create( array_merge([
                    'trunk_id' => $trunk->id
                ], $item ) );
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SIPTrunk $trunk)
    {
        return view('admin.siptrunk.delete', compact('trunk'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SIPTrunk $trunk)
    {
        $trunk->delete();
    }


        /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $trunks = SIPTrunk::select(array('sip_trunks.id', 'sip_trunks.name','sip_trunks.active', 'sip_trunks.workspace_id', 'sip_trunks.created_at'));

        return Datatables::of($trunks)
            ->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/trunk/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/trunk/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
