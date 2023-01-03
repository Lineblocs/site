<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Customizations;
use App\ApiCredential;
use Illuminate\Http\Request;
use Exception;
use Log;

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
				try {
					$this->removeFile( $record->{$key} );
				} catch ( Exception $ex ) {
					Log::error('error occured while removing image: ' . $ex->getMessage());
				}
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
		if ($request->hasFile('alt_app_logo')) {
			$alt_app_logo = $this->processUploadedFile($request, $record, 'alt_app_logo');
			if ( !$alt_app_logo ) {
				$session = $request->session();
				$session->flash('type', 'error');
				$session->flash('message', 'Could not save app logo');
				return redirect("/admin/customizations");
			}
			$update_params['alt_app_logo'] = $alt_app_logo;
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
		$payments_enabled = false;

		if ( $update_params['payment_gateway_enabled'] =='yes') {
			$payments_enabled = true;
		}
		$update_params['payment_gateway_enabled'] = $payments_enabled;

		$custom_code_containers_enabled = false;

		if ( $update_params['custom_code_containers_enabled'] =='yes') {
			$custom_code_containers_enabled = true;
		}
		$update_params['custom_code_containers_enabled'] = $custom_code_containers_enabled;
		$record->update( $update_params );
		$session = $request->session();
		$session->flash('type', 'success');
		$session->flash('message', 'Settings updated...');
        return redirect("/admin/customizations");
	}
}