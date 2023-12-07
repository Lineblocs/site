<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SIPRegion;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\SIPRegionRequest;
use App\Helpers\MainHelper;
use App\SIPRegionHost;
use App\SIPRegionRate;
use App\SIPRegionWhitelistIp;
use App\CallRate;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SIPRegionController extends AdminController
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
        view()->share('type', 'region');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.sipregion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = self::$countries; 
        $regionTypes = $this->regionTypes();
        return view('admin.sipregion.create_edit', compact('countries', 'regionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SIPRegionRequest $request)
    {

        $region = new SIPRegion ($request->all());
        $region->save();
        header("X-Goto-URL: /admin/region/" . $region->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SIPRegion $region)
    {
        $countries = self::$countries; 
        $hosts = SIPRegionHost::where('region_id', $region->id)->get();
        $ips = SIPRegionWhitelistIp::where('region_id', $region->id)->get();
        $regionTypes = $this->regionTypes();
        $ranges = [
            '/8' => '/8',
            '/16' => '/16',
            '/24' => '/24',
            '/32' => '/32',
        ];
        $rates = SIPRegionrate::select(
            DB::raw('sip_regions_rates.*, call_rates.name')
        );
        $rates->join('call_rates', 'call_rates.id', '=', 'sip_regions_rates.rate_ref_id');
        $rates = $rates->where('region_id', $region->id)->get();
        return view('admin.sipregion.create_edit', compact('region', 'countries', 'hosts', 'regionTypes', 'ips', 'ranges', 'rates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SIPRegionRequest $request, SIPRegion $region)
    {
        $region->update($request->all());
        header("X-Goto-URL: /admin/region/" . $region->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SIPRegion $region)
    {
        return view('admin.sipregion.delete', compact('region'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SIPRegion $region)
    {
        $region->delete();
    }


    public function add_host(SIPRegion $region)
    {
        return view('admin.sipregion.add_host', compact('region'));
    }

    public function add_host_save(Request $request, SIPRegion $region)
    {
        $data = $request->all();
        $host = SIPRegionHost::create(array_merge([
            'region_id' => $region->id
        ], $data));
        return response("");
    }


    public function edit_host(SIPRegion $region, SIPRegionHost $host)
    {
        return view('admin.sipregion.add_host', compact('region', 'host'));
    }

    public function edit_host_save(Request $request, SIPRegion $region, SIPRegionHost $host)
    {
        $data = $request->all();
        $host->update( $data );
            
        return response("");
    }


    public function del_host(Request $request, SIPRegion $region, SIPRegionHost $host)
    {
        $host->delete();
            
        return response("");
    }



    public function add_rate(SIPRegion $region)
    {
        $ratesQuery = CallRate::where('type', 'outbound')->get();
        $rates = [];
        foreach ($ratesQuery as $rate) {
            $rates[ $rate->id ] = $rate->name;
        }
        return view('admin.sipregion.add_rate', compact('region', 'rates'));
    }

    public function add_rate_save(Request $request, SIPRegion $region)
    {
        $data = $request->all();
        $rate = SIPRegionRate::create(array_merge([
            'region_id' => $region->id
        ], $data));
        return response("");
    }


    public function edit_rate(SIPRegion $region, SIPRegionRate $regionRate)
    {
        $ratesQuery = CallRate::where('type', 'outbound')->get();
$rates = [];

        foreach ($ratesQuery as $rate) {
            $rates[ $rate->id ] = $rate->name;
        }

        $args = [
            'region' => $region,
            'rate' => $regionRate,
            'rates' => $rates
        ];
        return view('admin.sipregion.add_rate', $args);
    }

    public function edit_rate_save(Request $request, SIPRegion $region, SIPRegionRate $regionRate)
    {
        $data = $request->all();
        $regionRate->update( $data );
            
        return response("");
    }


    public function del_rate(Request $request, SIPRegion $region, SIPRegionRate $regionRate)
    {
        $regionRate->delete();
            
        return response("");
    }



    public function add_ip(SIPRegion $region)
    {
        return view('admin.sipregion.add_ip', array(
            'region' => $region,
            'ranges' => self::$ipRanges
        ));
    }

    public function add_ip_save(Request $request, SIPRegion $region)
    {
        $data = $request->all();
        $ip = SIPRegionWhitelistIp::create(array_merge([
            'region_id' => $region->id
        ], $data));
        return response("");
    }


    public function edit_ip(SIPRegion $region, SIPRegionWhitelistIp $ip)
    {
        $params = array(
            'region' => $region,
            'ranges' => self::$ipRanges
        );

        return view('admin.sipregion.add_ip', $params);
    }

    public function edit_ip_save(Request $request, SIPRegion $region, SIPRegionWhitelistIp $ip)
    {
        $data = $request->all();
        $ip->update( $data );
            
        return response("");
    }


    public function del_ip(Request $request, SIPRegion $region, SIPRegionWhitelistIp $ip)
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
        $regions = SIPRegion::select(array('sip_regions.id', 'sip_regions.name','sip_regions.active', 'sip_regions.country', 'sip_regions.type_of_region', 'sip_regions.status', 'sip_regions.created_at'));

        return Datatables::of($regions)
            ->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/region/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/region/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
    public function regionTypes() {
        return [
            'inbound' => 'inbound',
            'outbound' => 'outbound',
            'both' => 'both'
        ];
    }
}
