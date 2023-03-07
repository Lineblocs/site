<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ResourceArticle;
use App\ResourceArticleDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\ResourceSection;
use App\Http\Requests\Admin\ResourceArticleRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class ResourceArticleController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'resourcearticle');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.resourcearticle.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $sections = ResourceSection::asSelect();
        return view('admin.resourcearticle.create_edit', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ResourceArticleRequest $request)
    {
        $data = $request->all();
        $resourcearticle = new ResourceArticle ($data);
        $resourcearticle->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(ResourceArticle $resourcearticle)
    {
        $sections = ResourceSection::asSelect();
        return view('admin.resourcearticle.create_edit', compact('resourcearticle', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(ResourceArticleRequest $request, ResourceArticle $resourcearticle)
    {
        $data = $request->all();
        $resourcearticle->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(ResourceArticle $resourcearticle)
    {
        return view('admin.resourcearticle.delete', compact('resourcearticle'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(ResourceArticle $resourcearticle)
    {
        $resourcearticle->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data(Request $request)
    {
        $section_id = $request->get('section_id');
        $resourcearticles = ResourceArticle::select(array('resource_articles.id', 'resource_articles.name', 'resource_articles.section_id', 'resource_articles.active', 'resource_articles.created_at'));
        if ( !empty($section_id)) {
            $resourcearticles = $resourcearticles->where('section_id', $section_id);
        }

        return Datatables::of($resourcearticles)
            ->add_column('actions', '<a href="{{{ url(\'admin/resourcearticle/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/resourcearticle/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')

            ->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->remove_column('id')
            ->make();
    }

}
