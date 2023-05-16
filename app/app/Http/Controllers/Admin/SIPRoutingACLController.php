<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SIPRoutingACL;
use App\SIPRoutingACLDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\SIPRoutingACLRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SIPRoutingACLController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'routingacl');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.routingacl.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $riskLevels = MainHelper::$aclRiskLevels;
        return view('admin.routingacl.create_edit', compact('riskLevels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SIPRoutingACLRequest $request)
    {
        $data = $request->all();
        $routingacl = new SIPRoutingACL ($data);
        $routingacl->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SIPRoutingACL $routingacl)
    {
        $riskLevels = MainHelper::$aclRiskLevels;
        return view('admin.routingacl.create_edit', compact('routingacl', 'riskLevels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SIPRoutingACLRequest $request, SIPRoutingACL $routingacl)
    {
        $data = $request->all();
        $routingacl->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SIPRoutingACL $routingacl)
    {
        return view('admin.routingacl.delete', compact('routingacl'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SIPRoutingACL $routingacl)
    {
        $routingacl->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $routingacls = SIPRoutingACL::select(array('sip_routing_acl.id', 'sip_routing_acl.iso', 'sip_routing_acl.name', 'sip_routing_acl.risk_level', 'sip_routing_acl.created_at'));

        return Datatables::of($routingacls)
            ->add_column('actions', '<a href="{{{ url(\'admin/routingacl/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/routingacl/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }

}
