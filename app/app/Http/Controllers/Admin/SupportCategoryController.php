<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SupportTicketCategory;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPProvider;
use App\SIPRateCenterProvider;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\SupportCategoryRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SupportCategoryController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'supportcategory');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.supportcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.supportcategory.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SupportCategoryRequest $request)
    {
        $data = $request->all();
        $category = SupportTicketCategory::create( $data );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SupportTicketCategory $supportcategory)
    {
          return view('admin.supportcategory.create_edit', compact('supportcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SupportCategoryRequest $request, SupportTicketCategory $supportcategory)
    {
        $data = $request->all();

        $supportcategory->update( $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SupportTicketCategory $supportcategory)
    {
          return view('admin.supportcategory.delete', compact('supportcategory'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SupportTicketCategory $supportcategory)
    {
        $supportcategory->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $categories = SupportTicketCategory::select(array('support_tickets_categories.id', 'support_tickets_categories.name', 'support_tickets_categories.created_at'));

        return Datatables::of($categories)
            ->add_column('actions', '<a href="{{{ url(\'admin/supportcategory/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/supportcategory/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
