<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ErrorUserTrace;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPProvider;
use App\SIPRateCenterProvider;
use App\Workspace;
use App\PortNumber;
use App\Http\Requests\Admin\ErrorTraceRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class RoutingEditorController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'routingeditor');
    }

    public function view()
    {
        $opensips_config = "";
        return view("admin.routingeditor.view", compact('opensips_config'));
    }

    public function save(Request $request)
    {
        $data =$request->all();
        $opensips_config = "";
		$session = $request->session();
		$session->flash('type', 'success');
		$session->flash('message', 'Routing configuration updated successfully...');
        return redirect("/admin/routingeditor");
    }
}
