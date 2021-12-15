<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ApiCredential;
use Illuminate\Http\Request;

class CustomizationsController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function view()
	{
		return view('admin.customizations.view',  []);
	}
	public function save(Request $req)
	{
        return redirect("/admin/customizations");
	}
}