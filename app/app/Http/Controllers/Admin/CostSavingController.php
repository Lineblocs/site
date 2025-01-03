<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\CostSaving;
use App\CostSavingDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\Competitor;
use App\Http\Requests\Admin\CostSavingRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class CostSavingController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'costsaving');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.costsaving.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $competitors = Competitor::asSelect();
        return view('admin.costsaving.create_edit', compact('competitors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CostSavingRequest $request)
    {
        $data = $request->all();
        $costsaving = new CostSaving ($data);
        $costsaving->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(CostSaving $costsaving)
    {
        $competitors = Competitor::asSelect();
        return view('admin.costsaving.create_edit', compact('costsaving', 'competitors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(CostSavingRequest $request, CostSaving $costsaving)
    {
        $data = $request->all();
        $costsaving->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(CostSaving $costsaving)
    {
        return view('admin.costsaving.delete', compact('costsaving'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(CostSaving $costsaving)
    {
        $costsaving->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $costsavings = CostSaving::select(array('cost_savings.id', DB::raw('competitors.name AS competitor_name'), 'cost_savings.created_at'));
        $costsavings->join('competitors', 'competitors.id', '=', 'cost_savings.competitor_id');

        return Datatables::of($costsavings)
            ->add_column('actions', '<a href="{{{ url(\'admin/costsaving/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/costsaving/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')

            ->remove_column('id')
            ->make();
    }

}
