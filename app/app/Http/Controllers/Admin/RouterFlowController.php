<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\RouterFlowRequest;
use App\RouterFlow;
use App\User;
use Datatables;

class RouterFlowController extends AdminController
{

    public function __construct()
    {
        view()->share('type', 'routerflow');
    }

    /*
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Show the page
        return view('admin.routerflow.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RouterFlowRequest $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(RouterFlow $flow)
    {
        $flowId = $flow->id;
        return view('admin.sipcountry.edit_flow', compact('flowId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(RouterFlowRequest $request, RouterFlow $flow)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(RouterFlow $flow)
    {
        return view('admin.routerflow.delete', compact('flow'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(RouterFlow $flow)
    {
        $flow->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $flows = RouterFlow::select(array('router_flows.id', 'router_flows.name', 'router_flows.created_at'));

        $dd = Datatables::of($flows)
            ->addColumn('actions', '<a href="{{{ url(\'admin/flow/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/flow/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->removeColumn('id')
            ->make();
        return $dd->original;
    }
}
