<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Customizations;
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
		$record = Customizations::getRecord();
		return view('admin.customizations.view',  ['record' => $record]);
	}

	private function storeUploadedFile( $file, $name ) {
			$file->move(base_path() . '/assets/img', $file_name);
	}
	private function removeFile( $name ) {
			unlink(base_path() . '/assets/img', $name);
	}
	private function processUploadedFile( $request, $key ) {
		if($request->hasFile($key) && $request->file($key)->isValid()){
			$logo = $request->file('app_logo');
			$file_name = str_random(30) . '.' . $file->getClientOriginalExtension();
			$this->storeUploadedFile( $logo,$file_name );
			if ( !empty( $record->app_logo ) ) {
				$this->removeFile( $record->app_logo );
			}
			return $file_name;
		}
		return FALSE;
	}
	public function save(Request $req)
	{
		$record = Customizations::getRecord();
		$update_params = $req->all();
		$app_logo = $this->processUploadedFile($request, 'app_logo');
		if ( !$app_logo ) {
			$session = $req->session();
			$session->flash('type', 'error');
			$session->flash('message', 'Could not save app logo');
			return redirect("/admin/settings");
		}
		$update_params['app_logo'] = $app_logo;
		$app_icon = $this->processUploadedFile($request, 'app_icon');
		if ( !$app_icon ) {
			$session = $req->session();
			$session->flash('type', 'error');
			$session->flash('message', 'Could not save app icon');
			return redirect("/admin/settings");
		}
		$update_params['app_icon'] = $app_icon;
		$admin_logo = $this->processUploadedFile($request, 'admin_portal_logo');
		if ( !$admin_logo ) {
			$session = $req->session();
			$session->flash('type', 'error');
			$session->flash('message', 'Could not save admin portal logo');
			return redirect("/admin/settings");
		}
		$update_params['admin_portal_logo'] = $admin_logo;
		$record->update( $update_params );
		$session = $req->session();
		$session->flash('type', 'success');
		$session->flash('message', 'Settings updated...');
        return redirect("/admin/customizations");
	}
}