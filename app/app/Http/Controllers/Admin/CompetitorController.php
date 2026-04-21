<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Competitor;
use App\CompetitorDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\CompetitorRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class CompetitorController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'competitor');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.competitor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.competitor.create_edit', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CompetitorRequest $request)
    {
        $data = $request->all();
        $competitor = new Competitor ($data);
        $competitor->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(Competitor $competitor)
    {
        return view('admin.competitor.create_edit', compact('competitor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(CompetitorRequest $request, Competitor $competitor)
    {
        $data = $request->all();
        $competitor->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(Competitor $competitor)
    {
        return view('admin.competitor.delete', compact('competitor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(Competitor $competitor)
    {
        $competitor->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $competitors = Competitor::select(array('competitors.id', 'competitors.name', 'competitors.created_at'));

        return Datatables::of($competitors)
            ->add_column('actions', '<a href="{{{ url(\'admin/competitor/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/competitor/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }

}
