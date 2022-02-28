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

	private function storeUploadedFile( $file, $file_name ) {
			$file->move(public_path() . '/assets/img/', $file_name);
	}
	private function removeFile( $name ) {
			unlink(public_path() . '/assets/img/'. $name);
	}
	private function processUploadedFile( $request,$record, $key ) {
		if($request->file($key)->isValid()){
			\Log::info("uploading file: " . $key);
			$file= $request->file($key);
			$file_name = str_random(30) . '.' . $file->getClientOriginalExtension();
			\Log::info("storing file..");
			$this->storeUploadedFile( $file,$file_name );
			if ( !empty( $record->{$key} ) ) {
				$this->removeFile( $record->{$key} );
			}
			return $file_name;
		}
		return FALSE;
	}
	public function save(Request $request)
	{
		$record = Customizations::getRecord();
		$update_params = $request->all();
		if ($request->hasFile('app_logo')) {
			$app_logo = $this->processUploadedFile($request, $record, 'app_logo');
			if ( !$app_logo ) {
				$session = $request->session();
				$session->flash('type', 'error');
				$session->flash('message', 'Could not save app logo');
				return redirect("/admin/customizations");
			}
			$update_params['app_logo'] = $app_logo;
		}
		if ($request->hasFile('app_icon')) {
			$app_icon = $this->processUploadedFile($request, $record, 'app_icon');
			if ( !$app_icon ) {
				$session = $request->session();
				$session->flash('type', 'error');
				$session->flash('message', 'Could not save app icon');
				return redirect("/admin/customizations");
			}
			$update_params['app_icon'] = $app_icon;
		}
		if ($request->hasFile('admin_portal_logo')) {
			$admin_logo = $this->processUploadedFile($request, $record, 'admin_portal_logo');
			if ( !$admin_logo ) {
				$session = $request->session();
				$session->flash('type', 'error');
				$session->flash('message', 'Could not save admin portal logo');
				return redirect("/admin/customizations");
			}
			$update_params['admin_portal_logo'] = $admin_logo;
		}
		$record->update( $update_params );
		$session = $request->session();
		$session->flash('type', 'success');
		$session->flash('message', 'Settings updated...');
        return redirect("/admin/customizations");
	}
}