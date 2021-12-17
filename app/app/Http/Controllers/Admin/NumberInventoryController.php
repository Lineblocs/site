<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\NumberInventory;
use App\Workspace;
use App\PortNumber;
use App\SIPProvider;
use App\SIPRouter;
use App\Http\Requests\Admin\NumberInventoryRequest;
use App\Helpers\MainHelper;
use App\NumberInventoryHost;
use App\NumberInventoryWhitelistIp;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class NumberInventoryController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'number');
    }
    public function getCountries()
    {
$countries = [
        'US' => 'United States',
        'UK' => 'United Kingdon',
        'CA' => 'Canada'
    ];
    return $countries;
}

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        $providers = SIPProvider::asSelect();
        $routers = SIPRouter::asSelect();
        $countries =$this->getCountries();
        return view('admin.number.index', compact('providers', 'countries', 'routers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries =$this->getCountries();
        $providers = SIPProvider::asSelect();
        $routers = SIPRouter::asSelect();
        return view('admin.number.create_edit', compact('providers', 'countries', 'routers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(NumberInventoryRequest $request)
    {

        $number = new NumberInventory ($request->all());
        $number->save();
        header("X-Goto-URL: /admin/number/" . $number->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(NumberInventory $number)
    {
    $providers = SIPProvider::asSelect();
        $countries =$this->getCountries();
        $routers = SIPRouter::asSelect();
        return view('admin.number.create_edit', compact('providers', 'number', 'countries', 'routers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(NumberInventoryRequest $request, NumberInventory $number)
    {
        $number->update($request->all());
        header("X-Goto-URL: /admin/number/" . $number->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(NumberInventory $number)
    {
        return view('admin.number.delete', compact('number'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(NumberInventory $number)
    {
        $number->delete();
    }


    public function import(Request $request)
    {
        return view('admin.number.import');
    }

    public function import_save(Request $request)
    {
        $session = $request->session();
        if(!$request->hasFile('file')) {
            return view('admin.number.import');
        }
        if($request->hasFile('file') && !$request->file('file')->isValid()){
            return view('admin.number.import');
        }
        $file = $request->file('file');
        $size = $file->getSize();
        $mime = $file->getMimeType();
        $path = $file->getPathName();
        $extension = $file->getClientOriginalExtension();
        $type = MainHelper::determineFileType($mime, $extension);

        if ( !$type ) {
            $session->flash('type', 'danger');
            $session->flash('message', 'Password did not match');
            return view('admin.number.import');
        }
        $file_name = str_random(30) . '.' . $file->getClientOriginalExtension();
        $contents = file_get_contents($file->getRealPath());
        if ( $type == 'csv' ) {
            $records = $this->parseCSV( $path );
        } else if ( $type == 'tsv' ) {
            $records = $this->parseCSV( $path, '\t' );
        } else if ( $type == 'xls' ) {
            $records = $this->parseXLS( $path );
        } else if ( $type == 'xlsx' ) {
            $records = $this->parseXLS( $path );
        }
        foreach ( $records as $record ) {
                $number = NumberInventory::create( $record );
        }
        $session->flash('type', 'success');
        $session->flash('message', 'Number(s) uploaded');
        return view('admin.number.import');
    }

    private function parseCSV( $path, $delim="," )
    {
        $row = 0;
        $map = array(
            0 => "api_number",
            1 => "country",
            2 => "region",
            3 => "monthly_cost",
            4 => "setup_cost",
            5 => "provider_id",
            6 => "routed_server"
        );


        $items = [];
        $handle = fopen($path, "r");

        if ( $handle == FALSE ) {
            return FALSE;
        }
        while (($data = fgetcsv($handle, 1000, $delim)) !== FALSE) {
            $num = count($data);
            $row++;
            if ( $row == 1 ) {
                continue; // headers
            }
            $item = [];
            for ($c=0; $c < $num; $c++) {
                $header = $map[$c];
                $value = $data[$c];
                if ( $header == 'provider_id' ) {
                    // check if need to lookup by name
                    $record = SIPProvider::where('name', $value)->first();
                    $determined_value = NULL;

                    if ( $record ) {
                        $determined_value = $record->id;
                    }

                    // lookup by ID
                    $record = SIPProvider::find( $value );
                    if ( $record ) {
                        $determined_value = $record->id;
                    }


                    if ( is_null( $determined_value ) ) {
                        // leave value blank in this case...
                        $value = "";
                    } else {
                        $value = $determined_value;
                    }
                } else  if ( $header == 'routed_server' ) {
                    // check if need to lookup by name
                    $record = SIPRouter::where('name', $value)->first();
                    $determined_value = NULL;
                    if ( $record ) {
                        $determined_value = $record->id;
                    }

                    // lookup by ID
                    $record = SIPRouter::find( $value );
                    if ( $record ) {
                        $determined_value = $record->id;
                    }

                    if ( is_null( $determined_value ) ) {
                        // leave value blank in this case...
                        $value = "";
                    } else {
                        $value = $determined_value;
                    }
                }
                $item[ $header ] = $value;
            }

            $items[] = $item;

        }
        fclose($handle);
        return $items;
    }
    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $numbers = NumberInventory::select(
            array('number_inventory.id', 
            'number_inventory.number',
            'number_inventory.region', 
            DB::raw('sip_providers.name'), 
            'number_inventory.created_at')
        );
        $numbers->join('sip_providers', 'sip_providers.id', '=', 'number_inventory.provider_id');

        return Datatables::of($numbers)
            //->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/number/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/number/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
