<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SystemStatusCategory;
use App\SystemStatusUpdate;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPProvider;
use App\SIPRateCenterProvider;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\SystemStatusRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SystemStatusController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'systemstatus');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.systemstatus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.systemstatus.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SystemStatusRequest $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SystemStatusCategory $systemstatus)
    {
        $updates = SystemStatusUpdate::where('category_id', $systemstatus->id)->get();
        return view('admin.systemstatus.create_edit', compact('systemstatus', 'updates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SystemStatusRequest $request, SystemStatusCategory $systemstatus)
    {
    }

    public function add_alert(SystemStatusCategory $systemstatus)

    {
        return view('admin.systemstatus.add_alert', compact('systemstatus'));
    }

    public function add_alert_save(Request $request, SystemStatusCategory $systemstatus)
    {
        $data = $request->all();
        $alert = SystemStatusUpdate::create([
            'category_id' => $systemstatus->id,
            'title' => $data['title'],
            'body' => $data['body'],
            'status' => $data['status']
        ]);
        MainHelper::sendSysUpdateOut($alert);
        //return response("");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SystemStatus $systemstatus)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SystemStatus $systemstatus)
    {
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $systemstatuss = SystemStatusCategory::select(array('system_status_categories.id', 'system_status_categories.name', 'system_status_categories.created_at'));

        return Datatables::of($systemstatuss)
            //->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/systemstatus/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
