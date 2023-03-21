<?php namespace App\Http\Controllers\Admin;

use App\Helpers\MainHelper;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\SIPRouterRequest;
use App\MediaServer;
use App\RTPProxy;
use App\SIPRouter;
use App\SIPRouterMediaServer;
use App\User;
use Datatables;
use Illuminate\Http\Request;

class SIPRouterController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

    /*
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Show the page

        return view('admin.siprouter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $ranges = MainHelper::$ipRanges;
        $regions = MainHelper::$regions;
        return view('admin.siprouter.create_edit', compact('ranges', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SIPRouterRequest $request)
    {

        $router = new SIPRouter($request->all());
        $router->save();
        header("X-Goto-URL: /admin/router/" . $router->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SIPRouter $router)
    {
        $ranges = MainHelper::$ipRanges;
        $regions = MainHelper::$regions;
        $servers = SIPRouterMediaServer::select(array('media_servers.*'));
        $servers->join('sip_routers', 'sip_routers.id', '=', 'sip_routers_media_servers.router_id');
        $servers->join('media_servers', 'media_servers.id', '=', 'sip_routers_media_servers.server_id');
        $servers->where('sip_routers_media_servers.router_id', '=', $router->id);
        $servers = $servers->get();
        return view('admin.siprouter.create_edit', compact('router', 'servers', 'ranges', 'regions'));
        $rtpproxies = RTPProxy::where('router_id', $router->id)->get();
        return view('admin.siprouter.create_edit', compact('router', 'servers', 'ranges', 'regions', 'rtpproxies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SIPRouterRequest $request, SIPRouter $router)
    {
        $router->update($request->all());
        header("X-Goto-URL: /admin/router/" . $router->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SIPRouter $router)
    {
        return view('admin.siprouter.delete', compact('router'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SIPRouter $router)
    {
        $router->delete();
    }

    public function add_server(SIPRouter $router)
    {
        $servers = MediaServer::asSelect();
        return view('admin.siprouter.add_server', compact('router', 'servers'));
    }

    public function add_server_save(Request $request, SIPRouter $router)
    {
        $data = $request->all();
        $server = SIPRouterMediaServer::create(array_merge([
            'router_id' => $router->id,
            'server_id' => $data['server_id'],
        ]));
        return response("");
    }

    public function del_server(Request $request, SIPRouter $router, SIPRouterMediaServer $server)
    {
        $server->delete();

        return response("");
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $routers = SIPRouter::select(array('sip_routers.id', 'sip_routers.name', 'sip_routers.active', 'sip_routers.region', 'sip_routers.created_at'));

        $dd = Datatables::of($routers)
            ->editColumn('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->addColumn('actions', '<a href="{{{ url(\'admin/router/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/router/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->removeColumn('id')
            ->make();
        return $dd->original;
    }
    public function routerTypes()
    {
        return [
            'inbound' => 'inbound',
            'outbound' => 'outbound',
            'both' => 'both',
        ];
    }
}
