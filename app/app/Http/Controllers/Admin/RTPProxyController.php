<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\RTPProxy;
use App\SIPRouter;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\RTPProxyRequest;
use App\Helpers\MainHelper;
use App\Helpers\SIPRouterHelper;
use App\RTPProxyHost;
use App\RTPProxyWhitelistIp;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class RTPProxyController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'rtpproxy');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.rtpproxy.index');
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
        return view('admin.rtpproxy.create_edit', compact('ranges', 'routers'));
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
    public function store(RTPProxyRequest $request)
    {

        $rtpproxy = new RTPProxy ($request->all());
        if (!MainHelper::validateRTPProxyAddress($rtpproxy->rtpproxy_sock)) {
            return abort(500, 'RTP proxy socket address is invalid');
        }

        $rtpproxy->save();
        SIPRouterHelper::addRTPProxy($rtpproxy->id,$rtpproxy->rtpproxy_sock);
        //header("X-Goto-URL: /admin/rtpproxy/" . $rtpproxy->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(RTPProxy $rtpproxy)
    {
        $ranges = $this->getPriorityRanges();
        $routers = SIProuter::asSelect();
        return view('admin.rtpproxy.create_edit', compact('rtpproxy', 'ranges', 'routers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(RTPProxyRequest $request, RTPProxy $rtpproxy)
    {
        $data = $request->all();

        if (!MainHelper::validateRTPProxyAddress($data['rtpproxy_sock'])) {
            return abort(500, 'RTP proxy socket address is invalid');
        }

        $rtpproxy->update($data);
        SIPRouterHelper::updateRTPProxy($rtpproxy->id,$rtpproxy->rtpproxy_sock);
        //header("X-Goto-URL: /admin/rtpproxy/" . $rtpproxy->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(RTPProxy $rtpproxy)
    {

        return view('admin.rtpproxy.delete', compact('rtpproxy'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(RTPProxy $rtpproxy)
    {
        $rtpproxy->delete();
        SIPRouterHelper::removeRTPProxy($rtpproxy->id);
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $rtpproxys = RTPProxy::select(array('rtpproxy_sockets.id', 'rtpproxy_sockets.rtpproxy_sock', 'rtpproxy_sockets.ip_address', 'rtpproxy_sockets.cpu_pct', 'rtpproxy_sockets.mem_pct', 'rtpproxy_sockets.created_at'));

        return Datatables::of($rtpproxys)
            //->edit_column('active', '@if ($active=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/rtpproxy/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/rtpproxy/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
