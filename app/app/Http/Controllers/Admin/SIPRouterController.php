<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SIPRouter;
use App\RTPProxy;
use App\Workspace;
use App\PortNumber;
use App\MediaServer;
use App\SIPProvider;
use App\SIPPoPRegion;
use App\Http\Requests\Admin\SIPRouterRequest;
use App\Helpers\MainHelper;
use App\SIPRouterMediaServer;
use App\SIPRouterDigitMapping;
use Datatables;
use DB;
use Config;
use Mail;
use Log;
use Illuminate\Http\Request;

class SIPRouterController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'router');
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
        $regions = SIPPoPregion::createSelectOptions();
        return view('admin.siprouter.create_edit', compact('ranges', 'regions'));
    }

    public function processRequest( $request ) {
        $data = $request->all();
        $result = [];
        $booleanKeys = [
            'udp_support',
            'tcp_support',
            'tls_support'
        ];
        foreach ( $data as $key => $value ) {
            if ( in_array( $key, $booleanKeys )) {
                $result[$key] = boolval( $value );
            } else {
                $result[$key] = $value;
            }
        }
        foreach ($booleanKeys as $key) {
            if(!isset($data[$key])) {
                $result[$key] = false;
            }
        }
        return $result;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SIPRouterRequest $request)
    {
        $data = $this->processRequest( $request );
        $router = new SIPRouter ($data);
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
        $regions = SIPPoPregion::createSelectOptions();
        $digitMappings = SIPRouterDigitMapping::select(array(
            'sip_routers_digit_mappings.*',
            DB::raw( 'route1.name AS route1_name' ),
            DB::raw( 'route2.name AS route2_name' ),
            DB::raw( 'route3.name AS route3_name' ),
            DB::raw( 'route4.name AS route4_name' ),
            DB::raw( 'route5.name AS route5_name' )
        ));
        $digitMappings->leftJoin(DB::raw('sip_providers route1'), 'route1.id', '=', 'sip_routers_digit_mappings.route1');
        $digitMappings->leftJoin(DB::raw('sip_providers route2'), 'route2.id', '=', 'sip_routers_digit_mappings.route2');
        $digitMappings->leftJoin(DB::raw('sip_providers route3'), 'route3.id', '=', 'sip_routers_digit_mappings.route3');
        $digitMappings->leftJoin(DB::raw('sip_providers route4'), 'route4.id', '=', 'sip_routers_digit_mappings.route4');
        $digitMappings->leftJoin(DB::raw('sip_providers route5'), 'route5.id', '=', 'sip_routers_digit_mappings.route5');

        $digitMappings->where('sip_routers_digit_mappings.router_id', $router->id);
        Log::info("digit mapping sql query: " . $digitMappings->toSql());
        $digitMappings = $digitMappings->get();

        $servers = SIPRouterMediaServer::select(array('media_servers.*'));
        $servers->join('sip_routers', 'sip_routers.id', '=', 'sip_routers_media_servers.router_id');
        $servers->join('media_servers', 'media_servers.id', '=', 'sip_routers_media_servers.server_id');
        $servers->where('sip_routers_media_servers.router_id', '=', $router->id);
        $servers = $servers->get();
        $rtpproxies = RTPProxy::where('router_id', $router->id)->get();
        
        return view('admin.siprouter.create_edit', compact('router', 'servers', 'ranges', 'regions', 'rtpproxies', 'digitMappings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SIPRouterRequest $request, SIPRouter $router)
    {
        $data = $this->processRequest( $request );
        $router->update($data);
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
            'server_id' => $data['server_id']
        ]));
        return response("");
    }


    public function del_server(Request $request, SIPRouter $router, SIPRouterMediaServer $server)
    {
        $server->delete();
            
        return response("");
    }


    public function add_digitmapping(SIPRouter $router)
    {
        $providers = SIPProvider::asSelect(true);
        return view('admin.siprouter.add_digitmapping', compact('router', 'providers'));
    }

    public function add_digitmapping_save(Request $request, SIPRouter $router)
    {
        $data = $request->all();
        $optionalKeys = [
            'route1',
            'route2',
            'route3',
            'route4',
            'route5'
        ];
        foreach ($optionalKeys as $key) {
            if (empty($data[$key])) {
                $data[$key] = NULL;
            }
        }
        $digitMapping = SIPRouterDigitMapping::create(array_merge([
            'router_id' => $router->id
        ], $data));
        return response("");
    }

    public function edit_digitmapping(SIPRouter $router, SIPRouterDigitMapping $digitMapping)
    {
        $providers = SIPProvider::asSelect(true);
        return view('admin.siprouter.add_digitmapping', compact('router', 'providers', 'digitMapping'));
    }

    public function edit_digitmapping_save(Request $request, SIPRouter $router, SIPRouterDigitMapping $digitMapping)
    {
        $data = $request->all();
        $optionalKeys = [
            'route1',
            'route2',
            'route3',
            'route4',
            'route5'
        ];
        foreach ($optionalKeys as $key) {
            if (empty($data[$key])) {
                $data[$key] = NULL;
            }
        }
        $digitMapping->update( $data );
        return response("");
    }
    public function del_digitmapping(Request $request, SIPRouter $router, SIPRouterDigitMapping $digitMapping)
    {
        $digitMapping->delete();
            
        return response("");
    }



    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $routers = SIPRouter::select(array('sip_routers.id', 'sip_routers.name','sip_routers.active', 'sip_routers.region', 'sip_routers.created_at'));

        return Datatables::of($routers)
            ->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/router/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/router/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
    public function routerTypes() {
        return [
            'inbound' => 'inbound',
            'outbound' => 'outbound',
            'both' => 'both'
        ];
    }
}
