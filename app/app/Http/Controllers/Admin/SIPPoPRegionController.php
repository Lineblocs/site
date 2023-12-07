<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SIPPoPRegion;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPProvider;
use App\SIPRateCenterProvider;
use App\RouterFlow;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\SIPPoPRegionRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SIPPoPRegionController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'popregion');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.sippopregion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sippopregion.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SIPPoPRegionRequest $request)
    {
        $region = new SIPPoPRegion ($request->all());
        $region->save();
        return view('admin.sippopregion.create_edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SIPPoPRegion $region)
    {
        return view('admin.sippopregion.create_edit', compact('region'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SIPPoPRegionRequest $request, SIPPoPRegion $region)
    {
        $region->update($request->all());
        header("X-Goto-URL: /admin/region/" . $region->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SIPPoPRegion $region)
    {
        return view('admin.sippopregion.delete', compact('region'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SIPPoPRegion $region)
    {
        $region->delete();
    }

    public function data()
    {
        $regions = SIPPoPRegion::select(array('sip_pop_regions.id', 'sip_pop_regions.name', 'sip_pop_regions.code', 'sip_pop_regions.created_at'));
        return Datatables::of($regions)
            //->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            // hide edit flow button for now
            // reenable it when the module is fully tested
            /*
            ->add_column('actions', '<a href="{{{ url(\'admin/region/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
            <a href="{{{ url(\'admin/region/\' . $id . \'/flow\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit_flow") }}</a>
                    <a href="{{{ url(\'admin/region/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
            */
            ->add_column('actions', '<a href="{{{ url(\'admin/region/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/region/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
