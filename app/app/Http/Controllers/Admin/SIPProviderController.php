<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SIPProvider;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\SIPProviderRequest;
use App\Helpers\MainHelper;
use App\SIPProviderHost;
use App\SIPProviderWhitelistIp;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SIPProviderController extends AdminController
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
        view()->share('type', 'provider');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.sipprovider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = self::$countries; 
        $providerTypes = $this->providerTypes();
        return view('admin.sipprovider.create_edit', compact('countries', 'providerTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SIPProviderRequest $request)
    {

        $provider = new SIPProvider ($request->all());
        $provider->save();
        header("X-Goto-URL: /admin/provider/" . $provider->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SIPProvider $provider)
    {
        $countries = self::$countries; 
        $hosts = SIPProviderHost::where('provider_id', $provider->id)->get();
        $ips = SIPProviderWhitelistIp::where('provider_id', $provider->id)->get();
        $providerTypes = $this->providerTypes();
        $ranges = [
            '/8' => '/8',
            '/16' => '/16',
            '/24' => '/24',
            '/32' => '/32',
        ];
        return view('admin.sipprovider.create_edit', compact('provider', 'countries', 'hosts', 'providerTypes', 'ips', 'ranges'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SIPProviderRequest $request, SIPProvider $provider)
    {
        $provider->update($request->all());
        header("X-Goto-URL: /admin/provider/" . $provider->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SIPProvider $provider)
    {
        return view('admin.sipprovider.delete', compact('provider'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SIPProvider $provider)
    {
        $provider->delete();
    }


    public function add_host(SIPProvider $provider)
    {
        return view('admin.sipprovider.add_host', compact('provider'));
    }

    public function add_host_save(Request $request, SIPProvider $provider)
    {
        $data = $request->all();
        $host = SIPProviderHost::create(array_merge([
            'provider_id' => $provider->id
        ], $data));
        return response("");
    }


    public function edit_host(SIPProvider $provider, SIPProviderHost $host)
    {
        return view('admin.sipprovider.add_host', compact('provider', 'host'));
    }

    public function edit_host_save(Request $request, SIPProvider $provider, SIPProviderHost $host)
    {
        $data = $request->all();
        $host->update( $data );
            
        return response("");
    }


    public function del_host(Request $request, SIPProvider $provider, SIPProviderHost $host)
    {
        $host->delete();
            
        return response("");
    }



    public function add_ip(SIPProvider $provider)
    {
        return view('admin.sipprovider.add_ip', array(
            'provider' => $provider,
            'ranges' => self::$ipRanges
        ));
    }

    public function add_ip_save(Request $request, SIPProvider $provider)
    {
        $data = $request->all();
        $ip = SIPProviderWhitelistIp::create(array_merge([
            'provider_id' => $provider->id
        ], $data));
        return response("");
    }


    public function edit_ip(SIPProvider $provider, SIPProviderWhitelistIp $ip)
    {
        $params = array(
            'provider' => $provider,
            'ranges' => self::$ipRanges
        );

        return view('admin.sipprovider.add_ip', $params);
    }

    public function edit_ip_save(Request $request, SIPProvider $provider, SIPProviderWhitelistIp $ip)
    {
        $data = $request->all();
        $ip->update( $data );
            
        return response("");
    }


    public function del_ip(Request $request, SIPProvider $provider, SIPProviderWhitelistIp $ip)
    {
        \Log::info("DELETING IP: " . $ip->ip_address);
        $ip->delete();
            
        return response("");
    }


    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $providers = SIPProvider::select(array('sip_providers.id', 'sip_providers.name','sip_providers.active', 'sip_providers.country', 'sip_providers.type_of_provider', 'sip_providers.created_at'));

        return Datatables::of($providers)
            ->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/provider/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/provider/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
    public function providerTypes() {
        return [
            'inbound' => 'inbound',
            'outbound' => 'outbound',
            'both' => 'both'
        ];
    }
}
