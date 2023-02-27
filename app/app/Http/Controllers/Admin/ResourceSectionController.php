<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ResourceSection;
use App\ResourceSectionDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\ResourceSectionRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class ResourceSectionController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'resourcesection');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.resourcesection.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.resourcesection.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ResourceSectionRequest $request)
    {
        $data = $request->all();
        $resourcesection = new ResourceSection ($data);
        $resourcesection->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(ResourceSection $resourcesection)
    {
        return view('admin.resourcesection.create_edit', compact('resourcesection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(ResourceSectionRequest $request, ResourceSection $resourcesection)
    {
        $data = $request->all();
        $resourcesection->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(ResourceSection $resourcesection)
    {
        return view('admin.resourcesection.delete', compact('plan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(ResourceSection $resourcesection)
    {
        $resourcesection->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $resourcesections = ResourceSection::select(array('resource_sections.id', 'resource_sections.name', 'resource_sections.description',  'resource_sections.created_at'));

        return Datatables::of($resourcesections)
            ->add_column('articles', '<a href="/admin/resourcearticle?section_id={{$id}}">View articles</a>')
            ->add_column('actions', '<a href="{{{ url(\'admin/resourcesection/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/resourcesection/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')

            ->remove_column('id')
            ->make();
    }

}
