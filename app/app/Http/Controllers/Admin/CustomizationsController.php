<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Customizations;
use App\ApiCredential;
use App\SIPPoPRegion;
use App\RegistrationQuestionnaire;
use App\Helpers\MainHelper;
use Illuminate\Http\Request;
use Exception;
use Log;

class CustomizationsController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	private function updateQuestionnaire($questionnaire) {
		$currentQuestions = RegistrationQuestionnaire::all();
		foreach ($questionnaire as $item) {
			if (isset($item['id'])) {
				$id = (int) $item['id'];
				foreach ($currentQuestions as $question) {
					if ($id == $question['id']) {
						$params = [
							'question' => $item['question']
						];
						$question->update( $params );
					}	
				}

				continue;
			}
			$params = [
				'question' => $item['question']
			];
			RegistrationQuestionnaire::create( $params );
		}
		foreach ($currentQuestions as $question) {
			$isDelete = TRUE;
			foreach ($questionnaire as $inputItem) {
				if (!isset($inputItem['id'])) {
					continue;
				}
				$id = (int) $inputItem['id'];
				if ($id == $question['id']) {
					$isDelete = FALSE;
					break;
				}
			}
			if ($isDelete) {
				$question->delete();
			}
		}
	}

	public function view()
	{
		$record = Customizations::getRecord();
		$maintenanceDays = [
			'monday',
			'tuesday',
			'wednesday',
			'thursday',
			'friday',
			'saturday',
			'sunday',
		];
		$maintenanceTimes = [
			'03:00–11:00 UTC'
		];
		$currencies = MainHelper::$currencies;
		$regions = SIPPoPRegion::all();
		$questionnaire = RegistrationQuestionnaire::all();
		$feedbackPlatforms = [
			'TrustPilot',
			'G2 Crowd',
		];
		return view('admin.customizations.view',  ['record' => $record, 'maintenanceDays' => $maintenanceDays, 'maintenanceTimes' => $maintenanceTimes, 'regions' => $regions, 'currencies' => $currencies, 'questionnaire' => $questionnaire, 'feedbackPlatforms' => $feedbackPlatforms]);
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


		$live_chat_enabled = false;

		if ( $update_params['live_chat_enabled'] =='yes') {
			$live_chat_enabled = true;
		}
		$update_params['live_chat_enabled'] = $live_chat_enabled;



		$billing_retry_enabled = false;

		if ( $update_params['billing_retry_enabled'] =='yes') {
			$billing_retry_enabled = true;
		}
		$update_params['billing_retry_enabled'] = $billing_retry_enabled;

		$zendesk_enabled = false;

		if ( $update_params['zendesk_enabled'] =='yes') {
			$zendesk_enabled = true;
		}
		$update_params['zendesk_enabled'] = $zendesk_enabled;




		$portal_analytics_enabled = false;

		if ( $update_params['portal_analytics_enabled'] =='yes') {
			$portal_analytics_enabled = true;
		}
		$update_params['portal_analytics_enabled'] = $portal_analytics_enabled;

		$signup_pay_details_required = false;

		if ( $update_params['signup_requires_payment_detail'] =='yes') {
			$signup_pay_details_required = true;
		}
		$update_params['signup_requires_payment_detail'] = $signup_pay_details_required;

		$register_credits_enabled = false;
		if ( $update_params['register_credits_enabled'] =='yes') {
			$register_credits_enabled = true;
		}
		$update_params['register_credits_enabled'] = $register_credits_enabled;

		$registration_questionnaire_enabled = false;
		if ( $update_params['registration_questionnaire_enabled'] =='yes') {
			$registration_questionnaire_enabled = true;
		}
		$update_params['registration_questionnaire_enabled'] = $registration_questionnaire_enabled;



		$enable_google_signin = false;

		if ( !empty( $update_params['enable_google_signin'] ) ) {
			$enable_google_signin = true;
		}
		$update_params['enable_google_signin'] = $enable_google_signin;

		$enable_msft_signin = false;
		if ( !empty( $update_params['enable_msft_signin'] ) ) {
			$enable_msft_signin = true;
		}
		$update_params['enable_msft_signin'] = $enable_msft_signin;

		$enable_apple_signin = false;
		if ( !empty( $update_params['enable_apple_signin'] ) ) {
			$enable_apple_signin = true;
		}
		$update_params['enable_apple_signin'] = $enable_apple_signin;

		$show_savings_content = false;

		if ( !empty( $update_params['show_savings_content'] ) ) {
			$show_savings_content = true;
		}
		$update_params['show_savings_content'] = $show_savings_content;



		$search_include_portal_views = false;
		$search_include_blog_views = false;
		$search_include_resources = false;

		$search_include_portal_views = false;
		if ( !empty( $update_params['search_include_portal_views'] ) ) {
			$search_include_portal_views = true;
		}
		$update_params['search_include_portal_views'] = $search_include_portal_views;

		$search_include_resources = false;
		if ( !empty( $update_params['search_include_resources'] ) ) {
			$search_include_resources = true;
		}
		$update_params['search_include_resources'] = $search_include_resources;

		$search_include_blog_views = false;
		if ( !empty( $update_params['search_include_blog_views'] ) ) {
			$search_include_blog_views = true;
		}
		$update_params['search_include_blog_views'] = $search_include_blog_views;
		

		$custom_code_containers_enabled = false;

		if ( $update_params['custom_code_containers_enabled'] =='yes') {
			$custom_code_containers_enabled = true;
		}
		$update_params['custom_code_containers_enabled'] = $custom_code_containers_enabled;


		$automatic_module_updates = false;

		if ( !empty( $update_params['automatic_module_updates'] ) ) {
			$automatic_module_updates = true;
		}
		$update_params['automatic_module_updates'] = $automatic_module_updates;

		$automatic_security_updates = false;

		$allow_app_feedback = false;

		if ( !empty( $update_params['allow_app_feedback'] ) ) {
			$allow_app_feedback = true;
		}
		$update_params['allow_app_feedback'] = $allow_app_feedback;




		$recaptcha_enabled = false;

		if ( !empty( $update_params['recaptcha_enabled'] ) ) {
			$recaptcha_enabled = true;
		}
		$update_params['recaptcha_enabled'] = $recaptcha_enabled;


		if ( !empty( $update_params['recaptcha_enabled'] ) ) {
			$recaptcha_enabled = true;
		}
		$update_params['recaptcha_enabled'] = $recaptcha_enabled;

		if ( !empty( $update_params['disqus_enabled'] ) ) {
			$disqus_enabled = true;
		}
		$update_params['disqus_enabled'] = $disqus_enabled;


		$questionnaire = $update_params['questionnaire'];
		unset( $update_params['questionnaire'] );
		$this->updateQuestionnaire($questionnaire);

		$record->update( $update_params );
		$session = $request->session();
		$session->flash('type', 'success');
		$session->flash('message', 'Settings updated...');
        return redirect("/admin/customizations");
	}
}