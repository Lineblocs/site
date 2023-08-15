<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Workspace;
use App\WorkspaceUser;
use App\PortNumber;
use App\Http\Requests\Admin\WorkspaceRequest;
use App\Helpers\MainHelper;
use App\Helpers\BillingDataHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class WorkspaceController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'workspace');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.workspace.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.workspace.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(WorkspaceRequest $request)
    {

        $workspace = new Workspace ($request->all());
        $workspace->save();
        header("X-Goto-URL: /admin/workspace/" . $workspace->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(Workspace $workspace)
    {
        $users = WorkspaceUser::select(array('workspaces_users.*', 'users.email'));
        $users->join('users', 'users.id', '=', 'workspaces_users.user_id');
        $users = $users->where('workspace_id', $workspace->id)->get();
        $creator = $workspace->getCreator();
        $billingHistory = BillingDataHelper::getBillingHistory($creator);

        return view('admin.workspace.create_edit', compact('workspace', 'users', 'billingHistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(WorkspaceRequest $request, Workspace $workspace)
    {
        $workspace->update($request->all());
        header("X-Goto-URL: /admin/workspace/" . $workspace->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(Workspace $workspace)
    {
        return view('admin.workspace.delete', compact('workspace'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(Workspace $workspace)
    {
        $workspace->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $workspaces = DB::table('workspaces')->select(array('workspaces.id', 'workspaces.name','workspaces.active', 'workspaces.created_at'));

        return Datatables::of($workspaces)
            ->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/workspace/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/workspace/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
