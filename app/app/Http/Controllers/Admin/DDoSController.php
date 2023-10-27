<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\DDoSSetting;
use App\ApiCredential;
use App\SIPPoPRegion;
use App\Helpers\MainHelper;
use Illuminate\Http\Request;
use Exception;
use Log;

class DDoSController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function view()
	{
		$record = DDoSSetting::getRecord();
		return view('admin.ddos.view',  ['record' => $record]);
	}

	public function save(Request $request)
	{
		$record = DDoSSetting::getRecord();
		$update_params = $request->all();

		$priority_aware_packet_policing = false;

		if ( !empty( $update_params['priority_aware_packet_policing'] ) ) {
			$priority_aware_packet_policing = true;
		}
		$update_params['priority_aware_packet_policing'] = $priority_aware_packet_policing;


		$media_packet_policing = false;
		if ( !empty( $update_params['media_packet_policing'] ) ) {
			$media_packet_policing = true;
		}
		$update_params['media_packet_policing'] = $media_packet_policing;

		$media_address_learning = false;
		if ( !empty( $update_params['media_address_learning'] ) ) {
			$media_address_learning = true;
		}
		$update_params['media_address_learning'] = $media_address_learning;

		$application_level_cac = false;
		if ( !empty( $update_params['application_level_cac'] ) ) {
			$application_level_cac = true;
		}
		$update_params['application_level_cac'] = $application_level_cac;


		$record->update( $update_params );
		$session = $request->session();
		$session->flash('type', 'success');
		$session->flash('message', 'Settings updated...');
        return redirect("/admin/ddos");
	}
}