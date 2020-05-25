<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\MediaServer;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\MediaServerRequest;
use App\Helpers\MainHelper;
use App\MediaServerHost;
use App\MediaServerWhitelistIp;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class MediaServerController extends AdminController
{
    public static $countries = [
        'US' => 'United States',
        'UK' => 'United Kingdon',
        'CA' => 'Canada'
    ];
    public static $ipRanges = [
            '/8' => '/8',
            '/16' => '/16',
            '/24' => '/24',
            '/32' => '/32',
        ];
    public function __construct()
    {
        view()->share('type', 'server');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.mediaserver.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $ranges = self::$ipRanges;
        return view('admin.mediaserver.create_edit', compact('ranges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MediaServerRequest $request)
    {

        $server = new MediaServer ($request->all());
        $server->save();
        header("X-Goto-URL: /admin/server/" . $server->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(MediaServer $server)
    {
        $ranges = self::$ipRanges;
        return view('admin.mediaserver.create_edit', compact('server', 'ranges'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(MediaServerRequest $request, MediaServer $server)
    {
        $server->update($request->all());
        header("X-Goto-URL: /admin/server/" . $server->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(MediaServer $server)
    {
        return view('admin.mediaserver.delete', compact('server'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(MediaServer $server)
    {
        $server->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $servers = MediaServer::select(array('media_servers.id', 'media_servers.name','media_servers.ip_address', 'media_servers.ip_address_range', 'media_servers.created_at'));

        return Datatables::of($servers)
            //->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/server/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/server/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
