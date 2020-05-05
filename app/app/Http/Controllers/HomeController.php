<?php

namespace App\Http\Controllers;

use App\Article;
use App\PhotoAlbum;
use App\SIPCountry;
use App\SIPRegion;
use App\SystemStatusCategory;
use App\SystemStatusUpdate;
use App\User;
use DB;
use View;
use Illuminate\Http\Request;
use Config;
use Mail;

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
          ]

        ],
        [
          'country' => [
            'code' => 'CA',
            'name' => 'Canada'
          ],
          'voice' => [
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
          ]

          ]
        ]
        ];
        $vars = array(
          'content' => $content
        );
        $country = $request->get("country");
        if ($country) {
          foreach ($content['rates'] as $rate) {
            if ($rate['country']['code'] == $country) {
              $vars['selected'] = $rate;
              break;
            }
          }
        }
    return view('pages.pricing', $vars);
  }
  public function features(Request $request)
  {
    $vars = [];
    return view('pages.features', $vars);
  }
  public function contact(Request $request)
  {
    $vars = [];
    return view('pages.contact', $vars);
  }
  public function contactSubmit(Request $request)
  {
    $data = $request->all();
    $vars = [];


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
    if (empty($data['comments'])) {
      $request->session()->flash('status', 'Please fill in comments..');
      return view('pages.contact', $vars);
    }



    $template = [
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'comments' => $data['comments']
    ];
    $config = Config::get("company_reps");
    Mail::send('emails.contact', $template, function ($m) use ($config) {
      $m->from('contact@lineblocs.com', 'Lineblocs Contact');

      $m->to($config['contact']['email_address'], $config['contact']['email_name'])->subject('New Lineblocs contact');
  });
    $request->session()->flash('status', 'Thanks for contacting us we will get in touch with you within 24-78 hours.');
    return view('pages.contact', $vars);
  }
  public function about(Request $request)
  {
    $vars = [];
    return view('pages.about', $vars);
  }

  public function login(Request $request)
  {
    return redirect("http://app.lineblocs.com/#/login");
  }
  public function backToBilling(Request $request)
  {
    return redirect("http://app.lineblocs.com/#/dashboard/billing?result=OK");
  }
  public function backToBillingCancel(Request $request)
  {
    return redirect("http://app.lineblocs.com/#/dashboard/billing?result=CANCEL");
  }
  public function emailVerify(Request $request)
  {
    $hash = $request->get("hash");
    $user = User::where('email_verify_hash', '=', $hash)->firstOrFail();
    $user->update([
      'email_verified' => TRUE
    ]) ;
    return redirect("http://app.lineblocs.com/#/login?result=email-verified");
  }
  public function ringcentral_alternative(Request $request)
  {
    return view('pages.ringcentral_alternative');
  }
  public function grasshopper_alternative(Request $request)
  {
    return view('pages.grasshopper_alternative');
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
    return view('pages.faqs');
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
    $categories = SystemStatusCategory::all();
    View::share("title", "Status");
    View::share("description", "Status updates for Lineblocs DID availability, media storage, PoP network and more..");
    View::share("tags", "system status, status, alerts");
    return view('status.main', compact('categories'));
  }
  public function status_category(Request $request, $categoryId)
  {
    $category = SystemStatusCategory::findOrFail($categoryId);
    $updates = SystemStatusUpdate::where('category_id', $category->id)->get();
    View::share("title", $category->name . " Status");
    View::share("description", "Status updates for Lineblocs " . $category->name);
    View::share("tags", "system status, status, alerts");

    return view('status.category', compact('category', 'updates'));
  }
  public function status_update(Request $request, $categoryId, $updateId)
  {
    $category = SystemStatusCategory::findOrFail($categoryId);
    $update = SystemStatusUpdate::findOrFail($updateId);
    View::share("title", $update->title);
    View::share("description", "Status update " . $update->title);
    View::share("tags", "system status, status, alerts");

    return view('status.update', compact('category', 'update'));

  }

}
