<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPProvider;
use App\SIPRateCenterProvider;
use App\RouterFlow;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\SIPCountryRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SIPCountryController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'country');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.sipcountry.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sipcountry.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SIPCountryRequest $request)
    {

        //create new flow

        $user = \Auth::user();
        /*
        $flow = RouterFlow::createFromTemplate('LCR', $user);
        */
        $data = $request->all();
        $flow = RouterFlow::create([
            'name' => 'flow for country: ' . $data['name'],
            'flow_json' => NULL
        ]);
        $country = new SIPCountry ($data);
        $country->flow_id = $flow->id;
        $country->save();
        header("X-Goto-URL: /admin/country/" . $country->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SIPCountry $country)
    {
        $regions =SIPRegion::where('country_id', $country->id)->get();
        return view('admin.sipcountry.create_edit', compact('country', 'regions'));
    }

    public function edit_flow(SIPCountry $country)
    {
        $flowId = $country->flow_id;
        return view('admin.sipcountry.edit_flow', compact('flowId'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SIPCountryRequest $request, SIPCountry $country)
    {
        $country->update($request->all());
        header("X-Goto-URL: /admin/country/" . $country->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SIPCountry $country)
    {
        return view('admin.sipcountry.delete', compact('country'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SIPCountry $country)
    {
        $country->delete();
    }


    public function add_region(SIPCountry $country)
    {
        return view('admin.sipcountry.add_region', compact('country'));
    }

    public function add_region_save(Request $request, SIPCountry $country)
    {
        $data = $request->all();
        $region = SIPRegion::create(array_merge([
            'country_id' => $country->id
        ], $data));
        return response("");
    }

    public function add_region_edit(SIPCountry $country, SIPRegion $region)
    {
        return view('admin.sipcountry.add_region', compact('country', 'region'));
    }

    public function add_region_edit_save(Request $request, SIPCountry $country, SIPregion $region)
    {
        $data = $request->all();
        $region->update($data);
        return response("");
    }

    public function add_ratecenter(SIPCountry $country, SIPRegion $region)
    {
        $providers =SIPProvider::all();
        return view('admin.sipcountry.add_ratecenter', compact('country', 'region', 'providers'));
    }

    public function add_ratecenter_save(Request $request, SIPCountry $country, SIPRegion $region)
    {
        $data = $request->all();
        $providers = [];
        if (isset($data['providers'])) {
            $data['providers'];
            unset($data['providers']);
        }
        $center = SIPRateCenter::create(array_merge($data, [
            'region_id' => $region->id
        ]));
        foreach ($providers as $id => $provider) {
            SIPRateCenterProvider::create([
                'center_id' => $center->id,
                'provider_id' => $id
            ]);
        }
        return response("");

    }
    public function add_ratecenter_edit(SIPCountry $country, SIPRegion $region, SIPRateCenter $center)
    {
        $providers =SIPProvider::all();
        $centerProviders =SIPRateCenterProvider::where('center_id', $center->id)->get();
        return view('admin.sipcountry.add_ratecenter', compact('country', 'region', 'center', 'providers', 'centerProviders'));
    }

    public function add_ratecenter_edit_save(Request $request, SIPCountry $country, SIPregion $region, SIPRateCenter $center)
    {
        $data = $request->all();
        $providers = [];
        if (isset($data['providers'])) {
            $providers = $data['providers'];
            unset($data['providers']);
        }

        $center->update($data);

        $centerProviders =SIPRateCenterProvider::where('center_id', $center->id)->get();
        foreach ($centerProviders as $cProvider) {
            $delete = TRUE;
            foreach ($providers as $provider) {
                if ($provider == $cProvider->provider_id) {
                    $delete = FALSE;
                }
            }
            if ($delete) {
                $cProvider->delete();
            }
        }
        foreach ($providers as $id => $provider) {
            $found = FALSE;
            foreach ($centerProviders as $cProvider) {
                if ($provider == $cProvider->provider_id) {
                    $found= TRUE;
                }
            }
            if (!$found) {
                SIPRateCenterProvider::create([
                    'center_id' => $center->id,
                    'provider_id' => $id
                ]);

            }


        }

        return response("");
    }
    public function del_region(Request $request, SIPCountry $country, SIPRegion $region)
    {
        $data = $request->all();
        $region->delete();
        
        return response("");
    }
public function del_ratecenter(Request $request, SIPCountry $country, SIPRegion $region, SIPRateCenter $center)
    {
        $center->delete();
        
        return response("");
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $countrys = SIPCountry::select(array('sip_countries.id', 'sip_countries.name', 'sip_countries.created_at'));

        return Datatables::of($countrys)
            //->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/country/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
            <a href="{{{ url(\'admin/country/\' . $id . \'/flow\' ) }}}" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit_flow") }}</a>
                    <a href="{{{ url(\'admin/country/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
