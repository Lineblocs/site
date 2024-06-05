<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\NumberService;
use App\NumberServiceDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\Competitor;
use App\Http\Requests\Admin\NumberServiceRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class NumberServiceController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'numberservice');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.numberservice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.numberservice.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(NumberServiceRequest $request)
    {
        $data = $request->all();
        $numberservice = new NumberService ($data);
        $numberservice->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(NumberService $numberservice)
    {
        return view('admin.numberservice.create_edit', compact('numberservice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(NumberServiceRequest $request, NumberService $numberservice)
    {
        $data = $request->all();
        $numberservice->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(NumberService $numberservice)
    {
        return view('admin.numberservice.delete', compact('numberservice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(NumberService $numberservice)
    {
        $numberservice->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $numberservices = NumberService::select(array('number_services.id', 'number_services.name', 'number_services.created_at'));

        return Datatables::of($numberservices)
            ->add_column('actions', '<a href="{{{ url(\'admin/numberservice/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/numberservice/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')

            ->remove_column('id')
            ->make();
    }

}
