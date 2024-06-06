<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\NumberService;
use App\NumberServiceConfig;
use App\NumberServiceDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\Competitor;
use App\Http\Requests\Admin\NumberServiceRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Log;
use Illuminate\Http\Request;

class NumberServiceController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'numberservice');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.numberservice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.numberservice.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(NumberServiceRequest $request)
    {
        $data = $request->all();
        if (empty($data['config_params'])) {
            $input_before = [];
        } else {
            $input_before = $data['config_params'];
        }

        unset($data['config_params']);
        $numberservice = new NumberService ($data);
        $numberservice->save();
        $config = [];
        $this->patchConfig( $numberservice, $config, $input_before );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(NumberService $numberservice)
    {
        $config = NumberServiceConfig::where('number_service_id', $numberservice->id)
                                        ->get()
                                        ->toArray();

        return view('admin.numberservice.create_edit', compact('numberservice', 'config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(NumberServiceRequest $request, NumberService $numberservice)
    {
        $data = $request->all();
        if (empty($data['config_params'])) {
            $input_before = [];
        } else {
            $input_before = $data['config_params'];
        }

        unset($data['config_params']);
        $numberservice->update($data);
        $config = NumberServiceConfig::where('number_service_id', $numberservice->id)->get();
        //Log::info(sprintf('input before %s', json_encode($input_before, JSON_PRETTY_PRINT)));
        $this->patchConfig( $numberservice, $config, $input_before );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(NumberService $numberservice)
    {
        return view('admin.numberservice.delete', compact('numberservice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(NumberService $numberservice)
    {
        $numberservice->delete();
    }

    private function transformFormInput( $input ) { // multi dimensional array
        //Log::info(sprintf('transform input is %s', json_encode($input, JSON_PRETTY_PRINT)));
        $keys = array_keys( $input );
        $results = [];
        if ( count( $keys ) == 0 ){
            return $results;
        }

        $item_keys = array_keys($input['param']);
        $results = [];
        foreach ($item_keys as $item_key) {
            $item = [];
            $item['param'] = $input['param'][$item_key];
            $item['value'] = $input['value'][$item_key];
            if (isset($input['id'][$item_key])) {
                $item['id'] = $input['id'][$item_key];
            }
            $results[] = $item;
        }
     
        return $results;
    }

    private function patchConfig( $number_service, $config, $input_before )
    {
        $input = $this->transformFormInput($input_before);
        //Log::info(sprintf('config input = %s', json_encode($input, JSON_PRETTY_PRINT)));

        foreach ( $config as $item ) {
            $found = FALSE;
            foreach ( $input as $item2 ) {
                if ( !isset( $item2['id'] ) ) {
                    continue;
                }

                $id = (int)  $item2['id'];
                if ( $item['id'] == $id ) {
                    $found = TRUE;
                }
            }
            if ( !$found ) {
                $item->delete();
            }
        }
        foreach ( $input as $item ) {
            $found = FALSE;

            foreach ( $config as $item2 ) {
                if ( !isset( $item['id'] ) ) {
                    continue;
                }
                $id = (int)  $item['id'];
                if ( $id == $item2['id'] ) {
                    $found = $item2;
                }
            }

            if ( $found ) {
                $found->update( $item );
            } else {
                NumberServiceConfig::create( array_merge([
                    'number_service_id' => $number_service->id
                ], $item ) );
            }
        }
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $numberservices = NumberService::select(array('number_services.id', 'number_services.name', 'number_services.created_at'));

        return Datatables::of($numberservices)
            ->add_column('actions', '<a href="{{{ url(\'admin/numberservice/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/numberservice/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')

            ->remove_column('id')
            ->make();
    }

}
