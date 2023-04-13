<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use \App\CompanyRepresentative;
use \App\CompanyRepresentativeOrigination;
use \App\CompanyRepresentativeOriginationEndpoint;
use \App\CompanyRepresentativeTermination;
use \App\CompanyRepresentativeTerminationAcl;
use \App\CompanyRepresentativeTerminationCredential;


use App\Workspace;
use App\PortNumber;
use App\DIDNumber;
use App\Http\Requests\Admin\CompanyRepresentativeRequest;
use App\Helpers\MainHelper;
use App\CompanyRepresentativeHost;
use App\CompanyRepresentativeRate;
use App\CompanyRepresentativeWhitelistIp;
use App\CallRate;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class CompanyRepresentativeController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'companyrepresentative');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.companyrepresentative.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.companyrepresentative.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CompanyRepresentativeRequest $request)
    {

        $companyrepresentative = new CompanyRepresentative ($request->all());
        $companyrepresentative->save();
        $this->ensureOnlyOneMainContact($companyrepresentative);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(CompanyRepresentative $companyrepresentative)
    {
        return view('admin.companyrepresentative.create_edit', compact('companyrepresentative'));
    }

    public function ensureOnlyOneMainContact(CompanyRepresentative $rep) {
        if ( $rep->main_contact ) {
            CompanyRepresentative::where('main_contact', '=', '1')
                ->where('id', '!=', $rep->id)
                ->update(['main_contact' => FALSE]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(CompanyRepresentativeRequest $request, CompanyRepresentative $companyrepresentative)
    {
        $data = $request->all();
        $companyrepresentative->update($data);
        $this->ensureOnlyOneMainContact($companyrepresentative);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(CompanyRepresentative $companyrepresentative)
    {
        return view('admin.companyrepresentative.delete', compact('companyrepresentative'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(CompanyRepresentative $companyrepresentative)
    {
        $companyrepresentative->delete();
    }


        /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $companyrepresentatives = CompanyRepresentative::select(array('company_representatives.id', 'company_representatives.name', 'company_representatives.email_address', 'company_representatives.created_at'));


        return Datatables::of($companyrepresentatives)
            ->add_column('actions', '<a href="{{{ url(\'admin/companyrepresentative/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/companyrepresentative/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
