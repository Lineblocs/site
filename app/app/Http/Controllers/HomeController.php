<?php

namespace App\Http\Controllers;

use App\Article;
use App\PhotoAlbum;
use App\SIPCountry;
use App\SIPRegion;
use App\SystemStatusCategory;
use App\SystemStatusUpdate;
use App\User;
use App\ServicePlan;
use App\Customizations;
use App\ApiCredential;
use App\Helpers\EmailHelper;
use App\Faq;
use App\CompanyRepresentative;
use DB;
use View;
use Illuminate\Http\Request;
use Config;
use Mail;
use App\Helpers\MainHelper;
use \ReCaptcha\ReCaptcha;

class HomeController extends BaseController {
  /**
   * Show the application dashboard to the user.
   *
   * @return Response
   */
  public function index()
  {

    $content = array(
      'main' => [
        'heading' => 'Your Line',
        'text' => 'LineBlocs make it easy to provision a cloud PBX and customize your inbound calling needs through visual flows',
      ],
      'blocks' => [
        'one' => [
          'title' => 'Fully Cloud',
          'text' => 'rent cloud numbers and use SIP trunks that are fully cloud based. Our cloud has you covered for building out a PBX suitable and not having to worry about maintenance costs / failover / hosting space.'
        ],
        'two' => [
          'title' => 'Modern Visual Editors',
          'text' => 'use a modern flow editor that includes all the kind of inbound calling tools you need to keep your business\'s phone system up to date and easy to use'
        ],
        'three' => [
          'title' => 'Support',
          'text' => 'we offer support around the clock to get you / your team up and running and ensure your phone system is stable, working and monitored'
        ]
        ]
    );
    $countries = SIPCountry::all();
    return view('pages.home', compact('content', 'countries'));
  }
  public function pricing(Request $request)
  {
    $plans = ServicePlan::where('include_in_pricing_pages', '1')->get();
    $plans = ServicePlan::sortPlansByFeatures($plans);
    return view('pages.pricing', [
      'plans' => $plans
    ]);
  }

  public function rates1(Request $request)
  {
    return redirect("/rates/US");
  }
  public function rates(Request $request, $countryId)
  {

    $outbound_csv =MainHelper::createUrl("/extra/outbound-call-rates.csv");
    $inbound_csv =MainHelper::createUrl("/extra/inbound-call-rates.csv");
    $content = [
      'main' => [
        'heading' => 'Voice pricing',
        'text' => 'below are our rates for voice pricing across our supported countries',
      ],
      'rates' => [
        [
          'country' => [
            'code' => 'US',
            'name' => 'United States'
          ],
          'voice' => [
            'outbound_csv' => $outbound_csv,
            'inbound_csv' => $inbound_csv,
            'all' => [
              'inbound_per_min' =>  '0.008',
              'outbound_per_min' =>  '0.008',
              'recording_per_min' => '0.0001',
            ],

            'local' => [
              'inbound_per_min' =>  '0.008',
              'outbound_per_min' =>  '0.008',
              'recording_per_min' => '0.0001',
              'rental_per_month' => '1.00',

            ],
            'toll-free' => [
              'inbound_per_min' =>  '0.008',
              'outbound_per_min' =>  '0.008',
              'recording_per_min' => '0.0001',
              'rental_per_month' => '1.00',
            ],
          ],
          'numbers' => [
              'local_per_month' => '1.00',
              'toll_free_per_month' => '2.00'
          ],
          'storage' => [
              'per_gb' => '0.008',
              'toll_free_per_month' => '2.00'
          ],

        ],
        [
          'country' => [
            'code' => 'CA',
            'name' => 'Canada'
          ],
          'voice' => [
            'outbound_csv' => $outbound_csv,
            'inbound_csv' => $inbound_csv,
            'all' => [
              'inbound_per_min' =>  '0.008',
              'outbound_per_min' =>  '0.008',
              'recording_per_min' => '0.0001',
            ],

            'local' => [
              'inbound_per_min' =>  '0.008',
              'outbound_per_min' =>  '0.008',
              'recording_per_min' => '0.0001',
              'rental_per_month' => '1.00',

            ],
            'toll-free' => [
              'inbound_per_min' =>  '0.008',
              'outbound_per_min' =>  '0.008',
              'recording_per_min' => '0.0001',
              'rental_per_month' => '1.00',
            ],
          ],
          'numbers' => [
              'local_per_month' => '1.00',
              'toll_free_per_month' => '2.00'
          ],
          'storage' => [
              'per_gb' => '0.008',
              'toll_free_per_month' => '2.00'
          ],
          ]
        ]
        ];
        $vars = array(
          'content' => $content
        );
  foreach ($content['rates'] as $rate) {
              if ($rate['country']['code'] == $countryId) {
                $vars['selected'] = $rate;
                break;
              }
            }

    return view('pages.rates', $vars);
  }
  public function features(Request $request)
  {
    $vars = [];
    return view('pages.features', $vars);
  }
  public function contact(Request $request)
  {
    $request->session()->forget('status');
    $creds = ApiCredential::getRecord();
    $customizations = Customizations::getRecord();
    $vars = [
      'customizations' => $customizations,
      'creds' => $creds
    ];
    return view('pages.contact', $vars);
  }
  public function contactSubmit(Request $request)
  {
    $data = $request->all();
    $creds = ApiCredential::getRecord();
    $customizations = Customizations::getRecord();
    $vars = [
        'customizations' => $customizations
    ];

    if($customizations->recaptcha_enabled) {
      $recaptcha = new ReCaptcha($creds->recaptcha_privatekey);
      $resp = $recaptcha->verify($data['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

		  if (!$resp->isSuccess()) {
        $request->session()->flash('status', 'Invalid captcha validation. Please try again.');
        return view('pages.contact', $vars);
		  }	
    }
    if (empty($data['first_name'])) {
      $request->session()->flash('status', 'Please fill in first name..');
      return view('pages.contact', $vars);
    }
    if (empty($data['last_name'])) {
      $request->session()->flash('status', 'Please fill in last name..');
      return view('pages.contact', $vars);
    }
    if (empty($data['email'])) {
      $request->session()->flash('status', 'Please fill in email..');
      return view('pages.contact', $vars);
    }
    if (empty($data['comments']) && empty($data['comments_not_required'])) {
      $request->session()->flash('status', 'Please fill in comments..');
      return view('pages.contact', $vars);
    }

    $template = [
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'comments' => $data['comments']
    ];
    $contact = CompanyRepresentative::getMainContact();
    $domain = MainHelper::getDeploymentDomain();
    $subject = sprintf('New %s contact', $domain);
    $result = EmailHelper::sendEmail($subject, $contact->email_address, 'contact', $template);
    $result = EmailHelper::sendEmail($subject, $template['email'], 'contact_confirm', $template);

    $request->session()->flash('status', 'Thanks for contacting us we will get in touch with you within 24-78 hours.');
    return view('pages.contact', $vars);
  }
  public function requestQuote(Request $request)
  {
    $request->session()->forget('status');
    $customizations = Customizations::getRecord();
    $creds = ApiCredential::getRecord();
    $teamSize = array(
      'small' => '1-50 employees',
      'medium' => '51-500 employees',
      'large' => '500-10000 employees',
      'really_large' => '10000+ employees',
    );
    $vars = [
      'customizations' => $customizations,
      'creds' => $creds,
      'teamSize' => $teamSize
    ];
    return view('pages.request_quote', $vars);
  }

  public function requestQuoteSubmit(Request $request)
  {
    $data = $request->all();
    $customizations = Customizations::getRecord();
    $creds = ApiCredential::getRecord();

    $teamSize = array(
      'small' => '1-50 employees',
      'medium' => '51-500 employees',
      'large' => '500-10000 employees',
      'really_large' => '10000+ employees',
    );
    $vars = [
      'customizations' => $customizations,
      'teamSize' => $teamSize
    ];

    if($customizations->recaptcha_enabled) {
      $recaptcha = new ReCaptcha($creds->recaptcha_privatekey);
      $resp = $recaptcha->verify($data['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

		  if (!$resp->isSuccess()) {
        $request->session()->flash('status', 'Invalid captcha validation. Please try again.');
        return view('pages.contact', $vars);
		  }	
    }

    if (empty($data['first_name'])) {
      $request->session()->flash('status', 'Please fill in first name..');
      return view('pages.request_quote', $vars);
    }
    if (empty($data['last_name'])) {
      $request->session()->flash('status', 'Please fill in last name..');
      return view('pages.request_quote', $vars);
    }
    if (empty($data['phone'])) {
      $request->session()->flash('status', 'Please fill in your phone number..');
      return view('pages.request_quote', $vars);
    }
    if (empty($data['email'])) {
      $request->session()->flash('status', 'Please fill in email..');
      return view('pages.request_quote', $vars);
    }
    if (empty($data['comments']) && empty($data['comments_not_required'])) {
      $request->session()->flash('status', 'Please fill in comments..');
      return view('pages.request_quote', $vars);
    }

    $template = [
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'company_name' => $data['company_name'],
      'team_size' => $data['team_size'],
      'phone' => $data['phone'],
      'email' => $data['email'],
      'comments' => $data['comments']
    ];
    $request_quote = CompanyRepresentative::getMainContact();
    $domain = 
    $domain =MainHelper::getDeploymentDomain();
    $subject = sprintf('New %s request_quote', $domain);

    $result = EmailHelper::sendEmail($subject, $request_quote->email_address, 'quote', $template);
    $result = EmailHelper::sendEmail($subject, $template['email'], 'quote_confirm', $template);

    $request->session()->flash('status', 'Thanks you, your request has been submitted successfully and someone will be in touch in 24-48 hours');
    return view('pages.request_quote', $vars);
  }


  public function bugReport(Request $request)
  {
    $request->session()->forget('status');
    $customizations = Customizations::getRecord();
    $creds = ApiCredential::getRecord();
    $bugTypes = array(
      'general' => 'Page not working',
    );
    $vars = [
      'customizations' => $customizations,
      'creds' => $creds,
      'bugTypes' => $bugTypes
    ];
    return view('pages.bug_report', $vars);
  }

  public function bugReportSubmit(Request $request)
  {
    $data = $request->all();
    $customizations = Customizations::getRecord();
    $creds = ApiCredential::getRecord();

    $bugTypes = array(
      'general' => 'Page not working',
    );

    $vars = [
      'customizations' => $customizations,
      'bugTypes' => $bugTypes
    ];

    if($customizations->recaptcha_enabled) {
      $recaptcha = new ReCaptcha($creds->recaptcha_privatekey);
      $resp = $recaptcha->verify($data['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

		  if (!$resp->isSuccess()) {
        $request->session()->flash('status', 'Invalid captcha validation. Please try again.');
        return view('pages.contact', $vars);
		  }	
    }

    if (empty($data['first_name'])) {
      $request->session()->flash('status', 'Please fill in first name..');
      return view('pages.bug_report', $vars);
    }
    if (empty($data['last_name'])) {
      $request->session()->flash('status', 'Please fill in last name..');
      return view('pages.bug_report', $vars);
    }
    if (empty($data['phone'])) {
      $request->session()->flash('status', 'Please fill in your phone number..');
      return view('pages.bug_report', $vars);
    }
    if (empty($data['email'])) {
      $request->session()->flash('status', 'Please fill in email..');
      return view('pages.bug_report', $vars);
    }
    if (empty($data['comments']) && empty($data['comments_not_required'])) {
      $request->session()->flash('status', 'Please fill in comments..');
      return view('pages.bug_report', $vars);
    }



    $template = [
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'phone' => $data['phone'],
      'email' => $data['email'],
      'comments' => $data['comments'],
      'bug_type' => $data['bug_type']
    ];
    $request_quote = CompanyRepresentative::getMainContact();
    $domain =MainHelper::getDeploymentDomain();
    $subject = sprintf('New %s bug_report', $domain);
    $result = EmailHelper::sendEmail($subject, $request_quote->email_address, 'bug_report', $template);

    $request->session()->flash('status', 'Thanks you, your request has been submitted successfully. Someone will be in touch in 24-48 hours');
    return view('pages.request_quote', $vars);
  }

  public function leaveFeedback(Request $request)
  {
    $data = $request->all();
    $customizations = Customizations::getRecord();
    $vars = [
      'customizations' => $customizations
    ];
    return view('pages.leave_feedback', $vars);
  }
  public function alternative(Request $request)
  {
    $vars = [];
    return view('pages.alternative', $vars);
  }
  public function alternativeSubmit(Request $request)
  {
    $vars = [];
    return view('pages.alternative', $vars);
  }

  public function about(Request $request)
  {
    $vars = [];
    return view('pages.about', $vars);
  }

  public function login(Request $request)
  {
    return redirect(mainhelper::createappurl("/#/login"));
  }
  public function backToBilling(Request $request)
  {
    return redirect(MainHelper::createAppUrl("/#/dashboard/billing?result=OK"));
  }
  public function backToBillingCancel(Request $request)
  {
    return redirect(MainHelper::createAppUrl("/#/dashboard/billing?result=CANCEL"));
  }
  public function emailVerify(Request $request)
  {
    $hash = $request->get("hash");
    $user = User::where('email_verify_hash', '=', $hash)->firstOrFail();
    $user->update([
      'email_verified' => TRUE
    ]) ;
    return redirect(MainHelper::createAppUrl("/#/login?result=email-verified"));
  }
  public function alternative_ringcentral(Request $request)
  {
    return view('pages.alternative', ['competitor' => 'RingCentral']);
  }
    public function alternative_nextiva(Request $request)
    {
        return view('pages.alternative', ['competitor' => 'Nextiva']);
    }
    public function alternative_dialpad(Request $request)
    {
        return view('pages.alternative', ['competitor' => 'Dialpad']);
    }
    public function alternative_grasshopper(Request $request)
    {
        return view('pages.alternative', ['competitor' => 'Grasshopper']);
    }
    public function cloud_native_solutions(Request $request)
    {
        return view('pages.cloud-native-solutions');
    }
  public function flowbuilder_features(Request $request)
  {
    return view('pages.flowbuilder_features');
  }
  public function didnumbers_features(Request $request)
  {
    return view('pages.didnumbers_features');
  }
  public function pops_features(Request $request)
  {
    return view('pages.pops_features');
  }
  public function faqs(Request $request)
  {
    $faqs = Faq::all();
    return view('pages.faqs', compact('faqs'));
  }
  public function ucaas(Request $request)
  {
    return view('pages.ucaas');
  }
  public function ucaas_country(Request $request, $country)
  {
    $data = self::$areas[ $country ];
    return view('pages.ucaas_country', compact('country', 'data'));
  }
  
  public function ucaas_services(Request $request, $countryIso, $regionCode)
  {
    $countryObj = SIPCountry::where('iso', strtoupper($countryIso))->firstOrFail();
    $regionObj = SIPRegion::where('country_id', $countryObj->id)->where('code', strtoupper($regionCode))->firstOrFail();
    $info = array(
      'country' => $countryObj,
      'region' => $regionObj,
    );
    $tags = [
      $countryObj->name,
      $countryObj->iso,
      $regionObj->name,
      'SIP trunking',
      'fax',
      'ucaas',
      'video',
      'collaboration'
    ];

    View::share('title', 'Call, IM and Fax services');
    View::share('tags', implode(",", $tags));
    return view('pages.ucaas_services', $info);
  }

  public function register(Request $request)
  {
    return view('register.step1');
  }
  public function register2(Request $request)
  {
    return view('register.step2');
  }
  public function register3(Request $request)
  {
    return view('register.step3');
  }
  public function register4(Request $request)
  {
    return view('register.step4');
  }
  public function register5(Request $request)
  {
    return view('register.step5');
  }
  public function status(Request $request)
  {
    $data = SystemStatusCategory::all();
    $categories = [];
    foreach ($data as $category) {
      $array = $category->toArray();
      $array['current_status'] = $category->checkStatus();
      $array['partial_degradation'] = $category->getPartialDegradation();
      $array['downtime'] = $category->getDowntime();
      $categories[] = $array;
    }

    $domain =MainHelper::getDeploymentDomain();
    View::share("title", "Status");
    View::share("description", "Status updates for ${domain} DID availability, media storage, PoP network and more..");
    View::share("tags", "system status, status, alerts");
    $date = new \DateTime();
    $date = $date->format("d F Y h:i A");
    return view('status.main', compact('categories', 'date'));
  }
  public function status_category(Request $request, $categoryId)
  {
    $domain =MainHelper::getDeploymentDomain();
    $category = SystemStatusCategory::findOrFail($categoryId);
    //$updates = SystemStatusUpdate::where('category_id', $category->id)->get();
    $updates = $category->getUpdates();
    View::share("title", $category->name . " Status");
    View::share("description", "Status updates for ${domain} " . $category->name);
    View::share("tags", "system status, status, alerts");

    return view('status.category', compact('category', 'updates'));
  }
  public function status_update(Request $request, $categoryId, $updateId)
  {
    $domain = MainHelper::getDeploymentDomain();
    $category = SystemStatusCategory::findOrFail($categoryId);
    $updateObj = SystemStatusUpdate::findOrFail($updateId);
    $update = $updateObj->toArray();
    $update['date_friendly'] = $updateObj->created_at->format("d F Y");
    View::share("title", $updateObj->title);
    View::share("description", "Status update " . $updateObj->title);
    View::share("tags", "system status, status, alerts");

    return view('status.update', compact('category', 'update', 'domain'));

  }
  public function notfound_404(Request $request)
  {
    return view('pages.notfound_404');
  }

}