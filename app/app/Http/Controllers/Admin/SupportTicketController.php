<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SupportTicket;
use App\SupportTicketUpdate;
use App\SupportTicketCategory;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPProvider;
use App\SIPRateCenterProvider;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\SupportTicketRequest;
use App\Helpers\MainHelper;
use Auth;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class SupportTicketController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'supportticket');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.supportticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.supportticket.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SupportTicketRequest $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(SupportTicket $supportticket)
    {
        $priorities = array(
            'LOW' => 'LOW',
            'MEDIUM' => 'MEDIUM',
            'HIGH' => 'HIGH'
        );
        $statuses = array(
            'OPEN' => 'OPEN',
            'CLOSED' => 'CLOSED',
        );
        $adminRecords = User::where('admin', '1')->get();
        $admins = [];
        foreach ( $adminRecords as $user ) {
            $admins[$user->id] = $user->email;
        }

        $categories = SupportTicketCategory::asSelect();
        $updates = SupportTicketUpdate::where('ticket_id', $supportticket->id)->get();

        return view('admin.supportticket.create_edit', compact('supportticket', 'priorities', 'updates', 'admins', 'statuses', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(SupportTicketRequest $request, SupportTicket $supportticket)
    {
        $supportticket->update( $request->all() );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(SupportTicket $supportticket)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(SupportTicket $supportticket)
    {
    }

    public function addUpdate(Request $request, SupportTicket $supportticket)
    {
        $user = Auth::user();
        $data = $request->all();
        SupportTicketUpdate::create([
            'comment' => $data['comment'],
            'ticket_id' => $supportticket->id,
            'user_id' => $user->id,
            'direction' => 'STAFF'
        ]);

        return response();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data(Request $request)
    {
        $tickets = SupportTicket::select(array('support_tickets.id', 'support_tickets.workspace_id', 'support_tickets.subject', 'support_tickets.priority', 'support_tickets.created_at', 'support_tickets.category_id', 'support_tickets_categories.name'));
        $tickets = $tickets->join('support_tickets_categories', 'support_tickets_categories.id', '=', 'support_tickets.category_id');
        $tickets->orderBy('created_at', 'DESC');
        $workspaceId = $request->get('workspace_id');
        if (!empty($workspaceId)) {
            $tickets->where('workspace_id', $workspaceId);
        }
        $ticketId = $request->get('id');
        if (!empty($ticketId)) {
            $tickets->where('id', $ticketId);
        }

        return Datatables::of($tickets)
            ->add_column('actions', '<a href="{{{ url(\'admin/supportticket/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/supportticket/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
}
