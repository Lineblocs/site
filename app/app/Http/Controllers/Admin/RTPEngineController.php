<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\RTPEngine;
use App\SIPRouter;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\RTPEngineRequest;
use App\Helpers\MainHelper;
use App\Helpers\SIPRouterHelper;
use App\RTPEngineHost;
use App\RTPEngineWhitelistIp;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class RTPEngineController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'rtpengine');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.rtpengine.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $ranges = $this->getPriorityRanges();
        $routers = SIProuter::asSelect();
        return view('admin.rtpengine.create_edit', compact('ranges', 'routers'));
    }

    private function getPriorityRanges() {
        $ranges = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
        ];
        return $ranges;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RTPEngineRequest $request)
    {
        $rtpengine = new RTPEngine ($request->all());
        /*
        if (!MainHelper::validateRTPProxyAddress($rtpengine->socket)) {
            return abort(500, 'RTP engine socket address is invalid');
        }
        */

        $rtpengine->save();
        SIPRouterHelper::addRTPEngine($rtpengine->id,$rtpengine->socket);
        //header("X-Goto-URL: /admin/rtpengine/" . $rtpengine->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(RTPEngine $rtpengine)
    {
        $ranges = $this->getPriorityRanges();
        $routers = SIProuter::asSelect();
        return view('admin.rtpengine.create_edit', compact('rtpengine', 'ranges', 'routers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(RTPEngineRequest $request, RTPEngine $rtpengine)
    {
        $data = $request->all();

        if (!MainHelper::validateRTPProxyAddress($data['socket'])) {
            return abort(500, 'RTP engine socket address is invalid');
        }

        $rtpengine->update($data);
        SIPRouterHelper::updateRTPEngine($rtpengine->id,$rtpengine->socket);
        //header("X-Goto-URL: /admin/rtpengine/" . $rtpengine->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(RTPEngine $rtpengine)
    {

        return view('admin.rtpengine.delete', compact('rtpengine'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(RTPEngine $rtpengine)
    {
        $rtpengine->delete();
        SIPRouterHelper::removeRTPEngine($rtpengine->id);
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $rtpengines = RTPEngine::select(array('rtpengine.id', 'rtpengine.socket', 'rtpengine.cpu_pct', 'rtpengine.mem_pct', 'rtpengine.created_at'));

        return Datatables::of($rtpengines)
            //->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/rtpengine/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/rtpengine/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
