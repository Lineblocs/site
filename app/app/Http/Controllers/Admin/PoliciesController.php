<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ApiCredential;
use App\Faq;
use App\PolicyPage;
use Illuminate\Http\Request;

class PoliciesController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function view()
	{
        $title = "Terms & Policies";
        $policies = PolicyPage::getRecord();
		return view('admin.policies.view',  compact('policies'));
	}
	public function save(Request $req)
	{
        $data = $req->all();
        $session = $req->session();
        $policies = PolicyPage::getRecord();
        $policies->update( $data );
        $session->flash('message', 'Policies saved successfully..');
        return redirect("/admin/policies");
	}
    }