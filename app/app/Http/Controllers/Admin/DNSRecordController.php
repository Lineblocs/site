<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\DNSRecord;
use App\Workspace;
use App\PortNumber;
use App\MediaServer;
use App\Http\Requests\Admin\DNSRecordRequest;
use App\Helpers\MainHelper;
use App\DNSRecordMediaServer;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class DNSRecordController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'dns');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.dnsrecords.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.dnsrecords.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(DNSRecordRequest $request)
    {

        $dns = new DNSRecord ($request->all());
        $dns->save();
        header("X-Goto-URL: /admin/dns/" . $dns->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(DNSRecord $dns)
    {
        return view('admin.dnsrecords.create_edit', compact('dns'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(DNSRecordRequest $request, DNSRecord $dns)
    {
        $dns->update($request->all());
        header("X-Goto-URL: /admin/dns/" . $dns->id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(DNSRecord $dns)
    {
        return view('admin.dnsrecords.delete', compact('dns'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(DNSRecord $dns)
    {
        $dns->delete();
    }



    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $dnss = DNSRecord::select(array('dns_records.id', 'dns_records.host','dns_records.type', 'dns_records.value', 'dns_records.ttl', 'dns_records.created_at'));

        return Datatables::of($dnss)
            ->add_column('actions', '<a href="{{{ url(\'admin/dns/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/dns/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
    public function dnsTypes() {
        return [
            'inbound' => 'inbound',
            'outbound' => 'outbound',
            'both' => 'both'
        ];
    }
}
