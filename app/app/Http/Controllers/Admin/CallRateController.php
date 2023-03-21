<?php namespace App\Http\Controllers\Admin;

use App\CallRate;
use App\CallRateDialPrefix;
use App\Helpers\MainHelper;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\CallRateRequest;
use App\User;
use Datatables;
use Illuminate\Http\Request;

class CallRateController extends AdminController
{
    public static $countries = [
        'US' => 'United States',
        'UK' => 'United Kingdon',
        'CA' => 'Canada',
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
        $rate = new CallRate($data);
        $rate->save();
        foreach ($prefixes as $prefix) {
            CallRateDialPrefix::create([
                'dial_prefix' => $prefix['dial_prefix'],
                'call_rate_id' => $rate->id,
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
            $found = false;
            foreach ($current as $item) {
                if (isset($prefix['id']) && $item->id == $prefix['id']) {
                    $found = true;
                }
            }
            if (!$found) {
                CallRateDialPrefix::create([
                    'dial_prefix' => $prefix['dial_prefix'],
                    'call_rate_id' => $rate->id,
                ]);
            }
        }
        foreach ($current as $item) {
            $found = false;
            foreach ($prefixes as $prefix) {
                if (isset($prefix['id']) && $item->id == $prefix['id']) {
                    $found = true;
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

        $dd = Datatables::of($rates)
            ->addColumn('actions', '<a href="{{{ url(\'admin/rate/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/rate/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->removeColumn('id')
            ->make();
        return $dd->original;
    }

    public function import(Request $request)
    {
        return view('admin.number.import');
    }

    public function import_save(Request $request)
    {
        $session = $request->session();
        if (!$request->hasFile('file')) {
            return view('admin.number.import');
        }
        if ($request->hasFile('file') && !$request->file('file')->isValid()) {
            return view('admin.number.import');
        }
        $file = $request->file('file');
        $size = $file->getSize();
        $mime = $file->getMimeType();
        $path = $file->getPathName();
        $extension = $file->getClientOriginalExtension();
        $type = MainHelper::determineFileType($mime, $extension);

        if (!$type) {
            $session->flash('type', 'danger');
            $session->flash('message', 'Password did not match');
            return view('admin.number.import');
        }
        $file_name = str_random(30) . '.' . $file->getClientOriginalExtension();
        $contents = file_get_contents($file->getRealPath());
        if ($type == 'csv') {
            $records = $this->parseCSV($path);
        } else if ($type == 'tsv') {
            $records = $this->parseCSV($path, '\t');
        } else if ($type == 'xls') {
            $records = $this->parseXLS($path);
        } else if ($type == 'xlsx') {
            $records = $this->parseXLS($path);
        }
        foreach ($records as $record) {
            $data = $record;
            $prefixes = $data['prefixes'];
            unset($data['prefixes']);
            $rate = CallRate::create($data);
            foreach ($prefixes as $prefix) {
                CallRateDialPrefix::create([
                    'call_rate_id' => $rate->id,
                    'dial_prefix' => $prefix,
                ]);
            }
        }
        $session->flash('type', 'success');
        $session->flash('message', 'Rate(s) uploaded');
        return view('admin.number.import');
    }
    private function parseCSV($path, $delim = ",")
    {
        $row = 0;
        $map = array(
            0 => "name",
            1 => "call_rate",
            2 => "type",
            3 => "inbound",
            4 => "prefixes",
        );

        $items = [];
        $handle = fopen($path, "r");

        if ($handle == false) {
            return false;
        }
        while (($data = fgetcsv($handle, 1000, $delim)) !== false) {
            $num = count($data);
            $row++;
            if ($row == 1) {
                continue; // headers
            }
            $item = [];
            $prefixesToAdd = [];
            for ($c = 0; $c < $num; $c++) {
                $header = $map[$c];
                $value = $data[$c];
                if ($header == 'prefixes') {
                    // check if need to lookup by name

                    $prefixesToAdd = implode(",", $value);
                    $item['prefixes'] = $prefixesToAdd;
                } else {
                    $item[$header] = $value;
                }
            }

            $items[] = $item;

        }
        fclose($handle);
        return $items;
    }
}
