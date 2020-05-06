<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ErrorUserTrace;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPProvider;
use App\SIPRateCenterProvider;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\ErrorTraceRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class ErrorTraceController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'errortrace');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.errortrace.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.errortrace.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ErrorTraceRequest $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(ErrorTraceCategory $errortrace)
    {
        return view('admin.errortrace.create_edit', compact('errortrace', 'updates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(ErrorTraceRequest $request, ErrorTraceCategory $errortrace)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(ErrorTrace $errortrace)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(ErrorTrace $errortrace)
    {
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $errortraces = ErrorUserTrace::select(array('error_user_trace.id', 'users.email', 'workspaces.name',  'error_user_trace.message', 'error_user_trace.full_url', 'error_user_trace.created_at'));
        $errortraces->leftJoin('users', 'users.id', '=', 'error_user_trace.user_id');
        $errortraces->leftJoin('workspaces', 'workspaces.id', '=', 'error_user_trace.workspace_id');

        return Datatables::of($errortraces)
            ->remove_column('id')
            ->make();
    }
}
