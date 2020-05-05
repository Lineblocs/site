<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\CallRate;
use App\CallRateDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\CallRateRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class CallRateController extends AdminController
{
    public static $countries = [
        'US' => 'United States',
        'UK' => 'United Kingdon',
        'CA' => 'Canada'
    ];

    public function __construct()
    {
        view()->share('type', 'rate');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.callrate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = self::$countries; 
        return view('admin.callrate.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CallRateRequest $request)
    {
        $data = $request->all();
        $prefixes = $data['prefixes'];
        unset($data['prefixes']);
        $rate = new CallRate ($data);
        $rate->save();
        foreach ($prefixes as $prefix) {
            CallRateDialPrefix::create([
                'dial_prefix' => $prefix['dial_prefix'],
                'call_rate_id' => $rate->id
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(CallRate $rate)
    {
        $prefixes = CallRateDialPrefix::where('call_rate_id', $rate->id)->get();
        return view('admin.callrate.create_edit', compact('rate', 'prefixes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(CallRateRequest $request, CallRate $rate)
    {
        $data = $request->all();
        $prefixes = $data['prefixes'];
        unset($data['prefixes']);
        $rate->update($data);
        $current = CallRateDialPrefix::where('call_rate_id', $rate->id)->get();
        foreach ($prefixes as $prefix) {
            $found = FALSE;
            foreach ($current as $item) {
                    if (isset( $prefix['id'] ) && $item->id == $prefix['id'] ) {
                        $found = TRUE;
                    }
                }
                if( !$found ) {
            CallRateDialPrefix::create([
                'dial_prefix' => $prefix['dial_prefix'],
                'call_rate_id' => $rate->id
            ]);
                }
        }
        foreach ($current as $item) {
            $found = FALSE;
            foreach ($prefixes as $prefix) {
                if (isset( $prefix['id'] ) && $item->id == $prefix['id'] ) {
                        $found = TRUE;
                    }
            }
            if (!$found) {
                $item->delete();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(CallRate $rate)
    {
        return view('admin.callrate.delete', compact('rate'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(CallRate $rate)
    {
        $rate->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $rates = CallRate::select(array('call_rates.id', 'call_rates.name', 'call_rates.type', 'call_rates.call_rate', 'call_rates.created_at'));

        return Datatables::of($rates)
            ->add_column('actions', '<a href="{{{ url(\'admin/rate/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/rate/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
