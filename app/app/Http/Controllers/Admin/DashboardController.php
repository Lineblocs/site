<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\SIPProvider;
use App\CallRate;

class DashboardController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function index()
	{
        $title = "Dashboard";

        $users = User::count();
        $sipproviders = SIPProvider::count();
        $callrates = CallRate::count();
		return view('admin.dashboard.index',  compact('title','users', 'sipproviders', 'callrates'));
	}
}