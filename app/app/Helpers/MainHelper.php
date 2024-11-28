<?php
namespace App\Helpers;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\DIDNumber;
use App\Extension;
use App\Workspace;
use App\SIPPoPRegion;
use App\Flow;
use App\FlowTemplate;
use App\ExtensionCode;
use App\UserCard;
use App\Customizations;
use App\CustomizationsKVStore;
use App\ApiCredential;
use App\ApiCredentialKVStore;
use App\SupportTicket;
use App\Helpersa\WebSvcHelper;
use Config;
use Auth;
use DB;
use Log;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\User;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use DateTime;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPRouter;
use App\CallRate;
use App\CallRateDialPrefix;
use Stripe\StripeClient;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Mail;


final class MainHelper {
    public static $ipRanges = [
            '/8' => '/8',
            '/16' => '/16',
            '/24' => '/24',
            '/32' => '/32',
        ];

    public static $aclRiskLevels = [
            'high' => 'High',
            'moderate' => 'Moderate',
            'low' => 'Low'
      ];
    public static $currencies = [
        'ALL' => 'Albania Lek',
        'AFN' => 'Afghanistan Afghani',
        'ARS' => 'Argentina Peso',
        'AWG' => 'Aruba Guilder',
        'AUD' => 'Australia Dollar',
        'AZN' => 'Azerbaijan New Manat',
        'BSD' => 'Bahamas Dollar',
        'BBD' => 'Barbados Dollar',
        'BDT' => 'Bangladeshi taka',
        'BYR' => 'Belarus Ruble',
        'BZD' => 'Belize Dollar',
        'BMD' => 'Bermuda Dollar',
        'BOB' => 'Bolivia Boliviano',
        'BAM' => 'Bosnia and Herzegovina Convertible Marka',
        'BWP' => 'Botswana Pula',
        'BGN' => 'Bulgaria Lev',
        'BRL' => 'Brazil Real',
        'BND' => 'Brunei Darussalam Dollar',
        'KHR' => 'Cambodia Riel',
        'CAD' => 'Canada Dollar',
        'KYD' => 'Cayman Islands Dollar',
        'CLP' => 'Chile Peso',
        'CNY' => 'China Yuan Renminbi',
        'COP' => 'Colombia Peso',
        'CRC' => 'Costa Rica Colon',
        'HRK' => 'Croatia Kuna',
        'CUP' => 'Cuba Peso',
        'CZK' => 'Czech Republic Koruna',
        'DKK' => 'Denmark Krone',
        'DOP' => 'Dominican Republic Peso',
        'XCD' => 'East Caribbean Dollar',
        'EGP' => 'Egypt Pound',
        'SVC' => 'El Salvador Colon',
        'EEK' => 'Estonia Kroon',
        'EUR' => 'Euro Member Countries',
        'FKP' => 'Falkland Islands (Malvinas) Pound',
        'FJD' => 'Fiji Dollar',
        'GHC' => 'Ghana Cedis',
        'GIP' => 'Gibraltar Pound',
        'GTQ' => 'Guatemala Quetzal',
        'GGP' => 'Guernsey Pound',
        'GYD' => 'Guyana Dollar',
        'HNL' => 'Honduras Lempira',
        'HKD' => 'Hong Kong Dollar',
        'HUF' => 'Hungary Forint',
        'ISK' => 'Iceland Krona',
        'INR' => 'India Rupee',
        'IDR' => 'Indonesia Rupiah',
        'IRR' => 'Iran Rial',
        'IMP' => 'Isle of Man Pound',
        'ILS' => 'Israel Shekel',
        'JMD' => 'Jamaica Dollar',
        'JPY' => 'Japan Yen',
        'JEP' => 'Jersey Pound',
        'KZT' => 'Kazakhstan Tenge',
        'KPW' => 'Korea (North) Won',
        'KRW' => 'Korea (South) Won',
        'KGS' => 'Kyrgyzstan Som',
        'LAK' => 'Laos Kip',
        'LVL' => 'Latvia Lat',
        'LBP' => 'Lebanon Pound',
        'LRD' => 'Liberia Dollar',
        'LTL' => 'Lithuania Litas',
        'MKD' => 'Macedonia Denar',
        'MYR' => 'Malaysia Ringgit',
        'MUR' => 'Mauritius Rupee',
        'MXN' => 'Mexico Peso',
        'MNT' => 'Mongolia Tughrik',
        'MZN' => 'Mozambique Metical',
        'NAD' => 'Namibia Dollar',
        'NPR' => 'Nepal Rupee',
        'ANG' => 'Netherlands Antilles Guilder',
        'NZD' => 'New Zealand Dollar',
        'NIO' => 'Nicaragua Cordoba',
        'NGN' => 'Nigeria Naira',
        'NOK' => 'Norway Krone',
        'OMR' => 'Oman Rial',
        'PKR' => 'Pakistan Rupee',
        'PAB' => 'Panama Balboa',
        'PYG' => 'Paraguay Guarani',
        'PEN' => 'Peru Nuevo Sol',
        'PHP' => 'Philippines Peso',
        'PLN' => 'Poland Zloty',
        'QAR' => 'Qatar Riyal',
        'RON' => 'Romania New Leu',
        'RUB' => 'Russia Ruble',
        'SHP' => 'Saint Helena Pound',
        'SAR' => 'Saudi Arabia Riyal',
        'RSD' => 'Serbia Dinar',
        'SCR' => 'Seychelles Rupee',
        'SGD' => 'Singapore Dollar',
        'SBD' => 'Solomon Islands Dollar',
        'SOS' => 'Somalia Shilling',
        'ZAR' => 'South Africa Rand',
        'LKR' => 'Sri Lanka Rupee',
        'SEK' => 'Sweden Krona',
        'CHF' => 'Switzerland Franc',
        'SRD' => 'Suriname Dollar',
        'SYP' => 'Syria Pound',
        'TWD' => 'Taiwan New Dollar',
        'THB' => 'Thailand Baht',
        'TTD' => 'Trinidad and Tobago Dollar',
        'TRY' => 'Turkey Lira',
        'TRL' => 'Turkey Lira',
        'TVD' => 'Tuvalu Dollar',
        'UAH' => 'Ukraine Hryvna',
        'GBP' => 'United Kingdom Pound',
        'USD' => 'United States Dollar',
        'UYU' => 'Uruguay Peso',
        'UZS' => 'Uzbekistan Som',
        'VEF' => 'Venezuela Bolivar',
        'VND' => 'Viet Nam Dong',
        'YER' => 'Yemen Rial',
        'ZWD' => 'Zimbabwe Dollar'
    ];

    public static function initStripe() {
        $credentials = ApiCredentialKVStore::getRecord();

        if ($credentials['stripe_mode'] == 'live') {
          \Stripe\Stripe::setApiKey($credentials['stripe_private_key']);
        } else if ($credentials['stripe_mode'] == 'test') {
          \Stripe\Stripe::setApiKey($credentials['stripe_test_private_key']);
        }
    }

    public static function initStripeClient() {
        $credentials = ApiCredentialKVStore::getRecord();

        $key = NULL;
        if ($credentials['stripe_mode'] == 'live') {
          $key = $credentials['stripe_private_key'];
        } else if ($credentials['stripe_mode'] == 'test') {
          $key = $credentials['stripe_test_private_key'];
        }

        return new StripeClient($key);
    }

  public static function createStripeCustomer($user, $paymentMethodId) {
    $stripe = self::initStripeClient();

    $email = $user->email;
    $subscription = NULL;
    $site = self::getSiteName();
    $description = sprintf('%s %s customer for %s', $user->first_name, $user->last_name, $site);
    // Create a customer with the payment method ID
    $customer = $stripe->customers->create([
        'email' => $email, // Customer's email address
        'description' => $description,
        'payment_method' => $paymentMethodId,
        'invoice_settings' => [
            'default_payment_method' => $paymentMethodId,
        ],
        // You can add more details like email, name, etc. as needed
    ]);

    Log::info(sprintf("created new stripe customer (%s)", $customer->id));
    return $customer;
  }

  public static function createApiId($prefix="") {
    $uuid4 = Uuid::uuid4(); 
    return sprintf("%s-%s",$prefix, $uuid4->toString());
  }
  public static function toDollars($cents, $currency=NULL) {
    if (!is_null($currency)) {
      return sprintf("%s %s", number_format(($cents /100), 2, '.', ' '), $currency);
    }

    return number_format(($cents /100), 2, '.', ' ');
  }
  public static function toCents($dollars) {
    $cents = \bcmul($dollars, 100);
    return  $cents;
  }
  public static function formatNumber($number, $places=2) {
      return number_format((float)$number, $places, '.', '');
  }
  public static function checkLimit($workspace, $user, $type) {
    $info =  $workspace->getPlanInfo();
    if ($type == "numbers") {
        $count = DIDNumber::where('workspace_id', '=', $user->id)->count();
        return FALSE;

    } elseif ($type == "extensions") {
        $count = Extension::where('user_id', '=', $user->id)->count();
        $limit =  $info['extensions'];
        if ($count >= $limit && !$info['unlimited_extensions']) {
          return TRUE;
        }
      }
    return FALSE;
   }
  public static function toE164($number) {
      $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
      $numberProto = $phoneUtil->parse($number, "US");
      if ( !  $phoneUtil->isValidNumber($numberProto) ) {
        return FALSE;
      }
      return $phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::E164);
  }
  public static function getPayPalContext() {

    $apiCredentials = ApiCredentialKVStore::getRecord();
    $clientId = NULL;
    $clientSecret = NULL;
    $mode = $apiCredentials['paypal_api_mode'];
    if ($mode) {
      $clientId = $apiCredentials['paypal_live_client_id'];
      $clientSecret = $apiCredentials['paypal_live_client_secret'];
    } else {
      $clientId = $apiCredentials['paypal_test_client_id'];
      $clientSecret = $apiCredentials['paypal_test_client_secret'];
    }

    //$config = Config::get("paypal");
    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientId,
            $clientSecret
        )
    );
    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration
    $apiContext->setConfig(
        array(
            'mode' => $mode,
            'log.LogEnabled' => true,
            'log.FileName' => base_path('logs/PayPal.log'),
            'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
      
            'cache.FileName' => base_path("caches/paypal")

            // 'http.CURLOPT_CONNECTTIMEOUT' => 30
            // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
            //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
        )
    );
    // Partner Attribution Id
    // Use this header if you are a PayPal partner. Specify a unique BN Code to receive revenue attribution.
    // To learn more or to request a BN Code, contact your Partner Manager or visit the PayPal Partner Portal
    // $apiContext->addRequestHeader('PayPal-Partner-Attribution-Id', '123123123');
    return $apiContext;
  }
  public static function getHostIPForUser($region, $user) {
      $info = User::whereNotNull('region')->get();
      $mothernode = Config::get("routerdata");
      $routers = SIPRouter::all();
      $proxy = '';
      foreach ( $routers as $router ) {
        if ( $router->region == $region ) {
          $proxy=$router->ip_address;
        }
      }

      // todo this should be handled before this step but remember to look into
      // $proxy variable possibly being unset here. if possible improve this workflow
      if ( empty ( $proxy )) { // region not available
      }
      return array(
          "region" => $region,
          "main" => $info,
          "proxy" => $proxy
       );
      return FALSE;
  }
  public static function createDNSRecordsForRouters() {
      $data = array();
      //$info = User::whereNotNull('region')->get();
      $config = Config::get("siprouter");
      $workspaces = Workspace::all();
      $routers = SIPRouter::all();
      foreach ($workspaces as $workspace) {
        $router = SIPRouter::select( array('sip_routers.*', 'sip_pop_regions.code') );
        $router->join('sip_pop_regions', 'sip_pop_regions.id', '=', 'sip_routers.region_id');
        $router = $router->first();
        
        if ( empty( $router ) ) {
          Log::error('SIP router not found for workspace region ' . $item->region);
          continue;
        }

        $user = User::find($workspace->creator_id);
        //$regions = WorkspaceRegion::where('workspace_id', $item->id)->get()->toArray();
        $regions = [
          [
            'internal_code' => $router->code,
            'router_ip' => $router->ip_address,
            'default' => $router->default
          ]
          ];
        $data[] = [
          'user' => $user,
          'workspace' => $workspace,
          'proxy_ip' => $router['ip_address'],
          'regions' => $regions
        ];
      }
      return $data;
  }
  public static function getPublicConfig()
    {
        $credentials = ApiCredentialKVStore::getRecord();
        $data = [];
        $data['stripe'] = [];

        if ($credentials['stripe_mode'] == 'live') {
          $data['stripe']['key'] = $credentials['stripe_pub_key'];
        } else if ($credentials['stripe_mode'] == 'test') {
          $data['stripe']['key'] = $credentials['stripe_test_pub_key'];
        }

        return $data;
    }

    public static function createUserWithoutPaymentGateway($data, $needsPasswordSet=FALSE) {
        $verifiedHash = MainHelper::emailVerifyHash($data['email']);
        $password = uniqid(TRUE);
        if (isset($data['password'])) {
          $password = $data['password'];
        }
        $defaulTheme = 'default';
        $params = [
          'first_name' => $data['first_name'], 
          'last_name' => $data['last_name'], 
          'email' => $data['email'],
          'email_verify_hash' => $verifiedHash,
          'email_verified' => FALSE,
          'username' => $data['email'],
          'password' => bcrypt($password),
          'confirmed' => 0,
			    'confirmation_code' => md5(microtime() . env('APP_KEY')),
          //'container_name' => $container,
          'trial_mode' => TRUE,
          'plan' => 'trial',
          'sip_port' => '5060',
          'rtp_ports' => '',
          'theme' => $defaulTheme
        ];
        if ($needsPasswordSet) {
          $params['needs_password_set'] = $needsPasswordSet;
          $now = new \DateTime();
          $params['needs_set_password_date'] = $now->format("Y-m-d H:i:s");
        }
        $user = User::create($params);
        return $user;
    }
  public static function createUser($data, $externalUser=FALSE) {
      $key = Config::get("stripe.secret_key");
      $customization = CustomizationsKVStore::getRecord();
      $user = MainHelper::createUserWithoutPaymentGateway($data);
      if ( $customization->payment_gateway_enabled && !$externalUser ) {
        if ( $customization->payment_gateway == 'stripe' ) {
          \Stripe\Stripe::setApiKey($key);

          $container = uniqid(TRUE);
          $customer = \Stripe\Customer::create([
            "description" => "Customer for " . $data['email']
          ]);
          $verifiedHash = MainHelper::emailVerifyHash($data['email']);
        
          $key = Config::get("stripe.secret_key");
          \Stripe\Stripe::setApiKey($key);

          $customer = \Stripe\Customer::create([
            "description" => "Customer for " . $data['email']
          ]);
          $user->update(['stripe_id' => $customer->id]);
        }
      }
      $user->update(['free_trial_started' => new DateTime()]);
      return $user;

  }
  public static function addSearch($request, $resource, $filters)
  {
    $search = $request->get("search");
    if ($search) {
      $resource->where(function($query) use ($filters, $search, $resource) { 
        foreach ($filters as $cnt => $filter) {
          if ($cnt == 0) {
              $query->where($filter, 'like', '%' . $search . '%');
          } else {
              $query->orWhere($filter, 'like', '%' . $search . '%');
          }
        }
      });
    }
    foreach ( $filters as $filter ) {
      $option = $request->get($filter);
      if ( $option ) {
          \Log::info("adding search option: " . $filter . " = " . $option);
          $resource->where($filter, 'like', '%' . $option . '%');
      }
    }
  }
  public static function emailVerifyHash($email) {
    $hashing = Config::get("hashing"); 
    return md5($hashing['main'].$email);
  }
  public static function CIDRMatch($ip, $range)
{
    list ($subnet, $bits) = explode('/', $range);
    if ($bits === null) {
        $bits = 32;
    }
    $ip = ip2long($ip);
    $subnet = ip2long($subnet);
    $mask = -1 << (32 - $bits);
    $subnet &= $mask; # nb: in case the supplied subnet wasn't correctly aligned
    return ($ip & $mask) == $subnet;
}
  public static function compileTypescript($content, &$output, &$return) {
    $url = "http://lineblocs-tsc-compiler/compile";
    $data = [
      'code' => $content
    ];
    $result = MainHelper::postJSON($url, $data);
    if ( $result ) {
      return $result;
    }
    return FALSE;
  }
  public static function makeParamsArray($array) {
     $result = [];
     foreach ($array as $value) {
        $result[$value['key']] = $value['value'];
      }
      return $result;
  }
  public static function provisionCallSystem($user, $workspace, $template)
  {
    $data = json_decode($template->data, TRUE);
    $baseParams = array(
      "user_id" => $user->id,
      "workspace_id" => $workspace->id
    );
    $createdFlows = [];
    foreach ($data['flows'] as $item) {
      $template = FlowTemplate::where('name', $item['template'])->first();
      if ( !$template ) {
        \Log::info("Warning: Could not find flow template: " .  $item['template']);
        continue;
      }
      $flow = Flow::createFromTemplate($item['template'], $user,$workspace,$template);
      $createdFlows[] = $flow;
    }
    foreach ($data['extensions'] as $extension) {
      $args = array_merge( $baseParams, $extension );
      foreach ($createdFlows as $flow) {
        if ($flow->name == $args['flow_name']) {
          $args['flow_id'] = $flow->id;
          unset($args['flow_name']);
          $args['secret'] = MainHelper::randomPassword();
          $extension = Extension::create($args);
          break;
        }
      }
    }

    foreach ($data['extension_codes'] as $extensionCode) {
      $args = array_merge( $baseParams, $extensionCode );
      foreach ($createdFlows as $flow) {
        if ($flow->name == $args['flow_name']) {
          $args['flow_id'] = $flow->id;
          unset($args['flow_name']);
          $code = ExtensionCode::create($args);
          break;
        }
      }
}

    $extensions = Extension::where('workspace_id', '=', $workspace->id)->get()->toArray();
    $status = SIPRouterHelper::provision($user, $workspace, $extensions);
    if (!$status) {
      return FALSE;
    }
    return TRUE;
  }
  public static function randomPassword1() {
      $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < 8; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
      }
      return implode($pass); //turn the array into a string
  }
  public static function randomPassword() {
    $generator = new ComputerPasswordGenerator();

    $generator
      ->setUppercase()
      ->setLowercase()
      ->setNumbers()
      ->setSymbols(TRUE)
      ->setLength(24);
      $password = $generator->generatePasswords(1)[0];

      $passwordIsComplaint = false;
      while (!$passwordIsComplaint) {
        $hasNumber = false;
        $hasSymbol = false;
        $hasLetter = false;

        if (preg_match('/\d+/', $password)) {
            $hasNumber = true;
        }

        if (preg_match('/[\W_]/', $password)) {
            $hasSymbol = true;
        }

        if (preg_match('/[a-zA-Z]/', $password)) {
          $hasLetter = true;
        }

        if (!$hasNumber || !$hasSymbol || !$hasLetter) {
          $password = $generator->generatePasswords(1)[0];
          continue;
        }

        $passwordIsComplaint = TRUE;
      }

      return $password;
  }
  public static function verifyPasswordStrength() {
  }



  public static function createAPIToken() {
    return bin2hex(random_bytes(16));
  }
  public static function createAPISecret() {
    return bin2hex(random_bytes(32));
  }
  public static function createJWTTokenArr($token, $user, $workspace) {
    if (!$token) {
        return $token;
    }
    return [
            'token' => MainHelper::createJWTPayload($token),
            'workspace' => $workspace->toArrayWithRoles($user)
            //'expire_in' => \Carbon\Carbon::now()->addMinutes(config('jwt.ttl'))->format('Y-m-d H:i:s')
        ];
  }
  public static function createJWTTokenArrFromUser($user, $workspace) {
    $token = JWTAuth::fromUser($user);
    if (!$token) {
        return $token;
    }
    return MainHelper::createJWTTokenArr($token, $user, $workspace);
  }

  public static function createJWTPayload($token) {
      $expireIn = \Carbon\Carbon::now()->addMinutes(config('jwt.ttl'));
      $formatted = $expireIn->format('Y-m-d H:i:s');
      $timestamp = $expireIn->getTimestamp();
      return [
              'auth' => $token,
              'expire_in' => $formatted,
              'expire_in_timestamp' => $timestamp
            ];
  }
  public static function checkUserInWorkspace($challenge, $user) {
        $workspace = Workspace::where('name', $challenge)->firstOrFail();
        $check = WorkspaceUser::where('user_id', $currentUser->id)->where('workspace_id', $workspace->id)->first();
        if (!$check) {
          return FALSE;
        }
      return TRUE;

  }
    public static function workspaceByDomain($domain) {
      $splitted = explode(".", $domain);
      $container = $splitted[0];
      $workspace = Workspace::where('name', $container)->firstOrFail();
      return $workspace;
  }
  public static function determineExtensionFromMime($mime) {
    $parts = explode("/", $mime);
    $extension = $parts[ 1 ];
    if ($extension == "wave") {
        $extension = "wav";
    }
    return $extension;
  }
  public static function createGoogleClientForUser($token) {
      $client  = new \Google_Client();
      $client->setApplicationName('Google Drive API PHP Quickstart');
      $client->setScopes(\Google_Service_Drive::DRIVE_METADATA_READONLY);
      $client->setAuthConfig(base_path('/credentials/google.json'));
      $client->setAccessType('offline');
      $client->setPrompt('select_account consent');
      $client->setAccessToken($token);
      return $client;
  }
  public static function getBillingHistory($user) {
      $data = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));      $data = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));
      $data = array_map(function($item) {
        $array = (array) $item;
        $array['dollars'] = MainHelper::toDollars($array['cents']);
        return $array; 
      }, $data);
      return $data;
      
  }

  public static function getCountries() {
    $data = [];
    $countries = SIPCountry::all();
    foreach ($countries as $country) {
        $data[] = [
            'id' => $country['id'],
            'iso' => $country['iso'],
            'name' => $country['name']
        ];

    }
    MainHelper::sortAlphabet($data, 'name');
    return $data;
  }
  public static function regionsList($countryId) {
    $data = [];
    $regions = SIPRegion::where('country_id', $countryId)->get();
    foreach ($regions as $region) {
      $data[] = [
        'id' => $region['id'],
        'code' => $region['code'],
        'name' =>  $region['name']
      ];
    }
    MainHelper::sortAlphabet($data, 'name');
    return $data;
  }
  public static function rateCentersList($countryId, $regionId) {
    $data = [];
    $centers = SIPRateCenter::where('region_id', $regionId)->get();
    foreach ($centers as $center) {
      $data[] = $center['name'];
    }
    return $data;
  }

  public static function updateModelTags($tags, $clazz, $value) {
        $obj = new $clazz;
        $all = $obj->getAllCurrentTags($value);
        foreach ($tags as $tag) {
            $current = FALSE;
            foreach ($all as $item) {
                if ($item->tag == $tag) {
                    $current = $item;
                    break;
                }
            }
            if (!$current) {
                $obj->createTag( $tag );
            }
        }
      foreach ($all as $tag) {
          $found = FALSE;
          foreach ($tags as $item) {
            if ($item == $tag->tag) {
              $found = TRUE;
            }
          }
          if (!$found) {
            $tag->delete();
          }
      }

  }
  public static function cleanWorkspaceName($name) {
      return strtolower($name);
  }
 public static function lookupBestCallRate($number, $direction) {
        $number = preg_replace("/^\+/", "", $number);
        $rates = CallRate::select(DB::raw("call_rates.*, call_rates_dial_prefixes.dial_prefix"));
        $rates->join('call_rates_dial_prefixes', 'call_rates_dial_prefixes.call_rate_id', '=', 'call_rates.id');
        $rates->where('call_rates.type', $direction);
        $rates = $rates->get();
        $match = NULL;
        foreach ($rates as $rate) {
          if (strncmp($number, $rate['dial_prefix'], strlen($rate['dial_prefix'])) == 0) {
             if (is_null($match)) {
               $match = $rate;
               continue;
             } 
             if (strlen($rate['dial_prefix']) > strlen( $match['dial_prefix'])) {
               $match = $rate;
               continue;
             }
          }
        }
        return $match;
    }
    public static function sendSysUpdateOut($update)
    {
        $users = User::all();
        $data = [
          'update' => $update
        ];
        $mail = Config::get("mail");
        foreach ($users as $user) {
          Mail::send('emails.sys_update', $data, function ($message) use ($user, $mail, $update) {
              //$message->to($user->email);
              $domain = self::getDeploymentDomain();
              $message->to("matrix.nad@gmail.com");
              $subject = sprintf("%s System Alert - %s", $domain, $update->title);
              $message->subject($subject);
              $from = $mail['from'];
              $message->from($from['address'], $from['name']);
          });
          break;
        }
    }
    public static function sortAlphabet(&$items, $key) {
      usort($items, function ($a, $b) use ($key) {
        return strcmp(strtolower($a[$key]), strtolower($b[$key]));
      });
    }
    public static function createWorkspaceLoginResult($token, $user, $workspace){
        $result = [
            'token' => MainHelper::createJWTPayload($token),
            'workspace' => $workspace->toArrayWithRoles($user),
            'enable_2fa' => $user->enable_2fa,
            'isAdmin' => FALSE,
            'adminWorkspaceToken' => ''
            //'expire_in' => \Carbon\Carbon::now()->addMinutes(config('jwt.ttl'))->format('Y-m-d H:i:s')
        ];
        if ($user->admin) {
          $admin = Config::get("admin");
          $token = $admin['frontend_token'];
          $result['isAdmin'] = TRUE;
          $result['adminWorkspaceToken'] = $token;
        }
        return $result;
    }
    public static function resolveAppId($model, $id) {
      if ( is_int( $id ) ) {
        return $id;
      }
      if ( is_string( $id )) {
        $result = $model->where('public_id', $id)->firstOrFail();
        return $result->id;
      }
      return NULL;
    }
    public static function secondsToHumanReadable(/*int*/ $seconds)/*: string*/ {
    //if you dont need php5 support, just remove the is_int check and make the input argument type int.
    if(!\is_int($seconds)){
        throw new \InvalidArgumentException('Argument 1 passed to secondsToHumanReadable() must be of the type int, '.\gettype($seconds).' given');
    }
    $dtF = new \DateTime ( '@0' );
    $dtT = new \DateTime ( "@$seconds" );
    $ret = '';
    if ($seconds === 0) {
        // special case
        return '0 seconds';
    }
    $diff = $dtF->diff ( $dtT );
    foreach ( array (
            'y' => 'year',
            'm' => 'month',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second' 
    ) as $time => $timename ) {
        if ($diff->$time !== 0) {
            $ret .= $diff->$time . ' ' . $timename;
            if ($diff->$time !== 1 && $diff->$time !== -1 ) {
                $ret .= 's';
            }
            $ret .= ' ';
        }
    }
    return substr ( $ret, 0, - 1 );
}


  public static function sendSMS($from='', $to='', $body='') {
    $customizations = CustomizationsKVStore::getRecord();
    ClassFinder::disablePSR4Vendors(); // Optional; see performance notes below
    $providers = ClassFinder::getClassesInNamespace('App\Helpers\Sms');
    $smsProvider = NULL;
    foreach ( $providers as $provider ) {
      $name = $provider::getProviderName();
      if ( $name == $customizations->sms_provider ) {
        $smsProvider = $provider;
        break;
      }
    }
    if (empty($smsProvider)) {
      // no provider implementation found
      Log::error("no sms provider implementation for: " . $customizations->sms_provider);
      return;
    }
    $providerObj = new $smsProvider();
    $providerObj->sendSMS($from, $to, $body);
  }

  public static function upgradeMembership($user, $workspace, $newMembership='') {
        $mail = Config::get("mail");
        $data = [];
        Mail::send('emails.upgrade_membership', $data, function ($message) use ($user, $workspace, $mail, $newMembership) {
            $message->to($user->email);
            $domain = self::getDeploymentDomain();
            $subject = sprintf("%s Membership upgraded to %s", $domain, $update->title);
            $message->subject($subject);
            $from = $mail['from'];
            $message->from($from['address'], $from['name']);
        });
  }
  public static function postJSON($url, $data = [])
  {
    $data_string = json_encode($data);                                                                                   
                                                                                                                        
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   
                                                                                                                        
    $result = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ( $http_status >= 200 && $http_status <= 299) {
      return json_decode($result, TRUE);
    }
    return FALSE;
  }
  public static function getRegions() {
    $results = [];
    $routers = SIPRouter::all();
    foreach ($routers as $item) {
      $results[] = [
        'name' => $item->name,
        'internal_code' => $item->region,
        'aws_code' => $item->name,
	'proxy' => [
		'publicIp' => $item->public_ip,
		'privateIp' => $item->private_ip,
	]
      ];
    }
    return $results;
  }
  public static function makeDomainName($name, $region='') {
    if (!empty($region)) {
         $subdomain = $name.".".$region;
         return self::createSubdomain($subdomain);
    }
    return self::createSubdomain($name);
  }
  public static function createJoinHash() {
    $hash = bin2hex(random_bytes(16));
    return $hash;
  }

  public static function chargeCard($user, $card, $amountInCents)
  {
    // TODO pull currency from database
    $currency = 'usd';
    $stripe = self::initStripeClient();
    $paymentMethodId = $card->stripe_payment_method_id;
    Log::info(sprintf('charging user %s cents', $amountInCents));

    $redirectUrl = self::createAppUrl('/confirm-payment-intent');
    $site = self::getShortName(TRUE);
    $descriptor = sprintf("%s credits", $site);
    $paymentIntent = $stripe->paymentIntents->create([
      'amount' => $amountInCents,
      'currency' => $currency,
      // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
      'automatic_payment_methods' => ['enabled' => true],
      'customer' => $user->stripe_id,
      'payment_method' => $paymentMethodId,
      'return_url' => $redirectUrl,
      'off_session' => true,
      'confirm' => true,
      //'statement_descriptor' => $descriptor
      'statement_descriptor_suffix' => $site
    ]);
  }

  public static function addCard($data, $user, $workspace, $isDefault=FALSE, $paymentGateway='stripe')
  {
    if ( $paymentGateway == 'stripe' ) {
      $stripe = self::initStripeClient();
      $paymentMethodId = $data['payment_method_id'];
      if (empty($user->stripe_id)) {
        $customer = MainHelper::createStripeCustomer($user, $paymentMethodId);
        Log::info(sprintf('created stripe customer %s', $customer->id));
      } else {
        $customer = $stripe->customers->retrieve($user->stripe_id, []);
        Log::info(sprintf('found stripe customer for user %s', $customer->id));
      }

      Log::info(sprintf('created stripe customer %s', $customer->id));
      $user->update([
        'stripe_id' => $customer->id
      ]);
      /*
      $card = \Stripe\Customer::createSource(
          $user->stripe_id,
          [
              'source' => $data['card_token']
          ]
      );
      */
      //$all = UserCard::where('workspace_id', $workspace->id)->get();
      if ( $isDefault ) {
        // update invoice settings to use this card as the default payment method

        $stripe->customers->update(
          $user->stripe_id,
          array(
              'invoice_settings' => array(
                'default_payment_method' => $paymentMethodId
              )
          )
        );
      }

      $cardIssuer = $data['issuer'];
      $last4 =  $data['last_4'];
      $params = [
          'last_4' => $last4,
          'stripe_payment_method_id' => $paymentMethodId,
          'user_id' => $user->id,
          'workspace_id' => $workspace->id,
          'issuer' => $cardIssuer,
          'primary' => $isDefault
      ];
      return UserCard::create($params);
    }
  }
  public static function makeCardPrimary($card, $user, $workspace)
  {
        $all = UserCard::where('workspace_id', $workspace->id)->update(['primary' => FALSE]);
        $card->update(['primary' => TRUE]);

      }

    public static function determineFileType( $mime, $extension ) {
            if ( $mime == 'text/csv') {
                return 'csv';
            }
            if ( $mime == 'text/plain' && $extension =='csv' ) {
                return 'csv';
            }

            if ( $mime == 'text/tsv') {
                return 'tsv';
            }
            if ( $mime == 'text/plain' && $extension =='tsv' ) {
                return 'tsv';
            }
            if (  $extension =='.xls') {
                return 'xls';
            }
            if (   $extension =='.xlsx') {
                return 'xlsx';
            }
            return FALSE;

    }
    public static function createCallRouterEditingUrl($user, $flowId)
    {

      if (!$token = JWTAuth::fromUser($user)) {
          \Log::error('could not create token');
          throw new \Exception( 'could not create token' );
      }

       // $result = MainHelper::createWorkspaceLoginResult($token, $user, $workspace);
       $params = sprintf( "?auth=%s&flowId=%s", $token, $flowId );
       //$url = "https://callroutedesigner.lineblocs.com/edit".$params;
       $url = "http://localhost:9000/edit".$params;
       return $url;
    }
    public static function createCallRoutereUrl2($user, $flowId)
    {

      if (!$token = JWTAuth::fromUser($user)) {
          \Log::error('could not create token');
          throw new \Exception( 'could not create token' );
      }

       // $result = MainHelper::createWorkspaceLoginResult($token, $user, $workspace);
       $params = sprintf( "?auth=%s&flowId=%s", $token, $flowId );
       //$url = "https://callroutedesigner.lineblocs.com/edit".$params;
       $url = "http://localhost:9000/edit".$params;
       return $url;
    }
    public static function createSIPTrunkTerminationURI($trunk_name) {
      return sprintf("%s.pstn", $trunk_name);
    }
    public static function adminLogo() {
        $cust = CustomizationsKVStore::getRecord()->toArray();
        $logo = $cust['admin_portal_logo'];
        if ( !empty( $logo )) {
          return sprintf("/assets/img/%s", $logo);
        }
        // old version
        //$default_logo = '/images/logo-white.png';
        $default_logo = '/images/logo-comp_03.png';
        return $default_logo;
    }
    public static function appLogo() {
        $cust = CustomizationsKVStore::getRecord();
        $logo = $cust['app_logo'];
        if ( !empty( $logo )) {
          return sprintf("/assets/img/%s", $logo);
        }
        // old version
        //$default_logo = '/images/logo-white.png';
        $default_logo = '/images/logo-comp_03.png';
        return $default_logo;
    }
    public static function createPortalLink($path='') {
      return sprintf("https://app.%s/%s", \Config::get("app.deployment_domain"), $path);
    }
   public static function createRegisterLink() {
      return self::createPortalLink('#/register');
    }
    public static function createResourceArticleUrl($article_key, $section_key) {
      return sprintf("https://%s/resources/%s/%s", \Config::get("app.deployment_domain"), $section_key, $article_key);
    }
    public static function createUrl($path='') {
      $domain = self::getDeploymentDomain();
      return sprintf("https://%s/%s", $domain, $path);
    }
    public static function createAppUrl($path) {
      return self::createSubdomainUrl("app", $path);
    }
    public static function createSubdomainUrl($subdomain, $path) {
      $subdomain  = self::createSubdomain($subdomain);
      return sprintf("https://%s/%s", $subdomain,$path);
    }
    public static function createSubdomain($subdomain) {
      $domain = self::getDeploymentDomain();
      return sprintf("%s.%s", $subdomain, $domain);
    }
    public static function createEmail($user) {
      $domain = self::getDeploymentDomain();
      return sprintf("%s@%s", $user, $domain);
    }

    // TODO: find a better way to get the IP incase
    // this is not running behind a apache server
    public static function getLocalIP() {

      if (array_key_exists('SERVER_ADDR', $_SERVER)) {
        return $_SERVER['SERVER_ADDR']; 
      }

      $conn = curl_init();
      curl_setopt($conn, CURLOPT_URL, 'example.org');
      curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
      $resp = curl_exec($conn);
      $defaultIP = curl_getinfo($conn)['local_ip'];

      return $defaultIP;
    }

    public static function getDeploymentDomain() {
      $domain = env('DEPLOYMENT_DOMAIN');
      return $domain;
    }

    public static function getAppDomain() {
      return sprintf('app.%s', self::getDeploymentDomain());
    }

    public static function getSiteName() {
      return Config::get("app.site_name");
    }

    public static function getShortName() {
      $site = self::getSiteName();
      return strtoupper(preg_replace('/\.[^.]+$/', '', $site));
    }
    public static function getCurrency() {
      return 'USD';
    }

    public static function createEmailSubject($subject) {
      $site = self::getSiteName();
      return sprintf("%s - %s", $site, $subject);
    }
    public static function createTitle($text) {
      $site = self::getSiteName();
      return sprintf("%s - %s", $site, $text);
    }
    public static function createDefaultTitle($text='Scalable phone system') {
      $site = self::getSiteName();
      return sprintf("%s - %s", $site, $text);
    }

    public static function getMonthlyInvoice($user, $monthDatetime) {
      $data  = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U 
      where U.user_id = "%s"
      and (DATE(U.created_at) = "%s")
      ;', $user->id, $monthDatetime->format("Y-m-d")));
        foreach ($data as $key => $item) {
          $item->balance = MainHelper::toDollars($item->balance);
          $item->dollars = MainHelper::toDollars($item->cents);
          $data[ $key] = $item;
        }

      return $data;
    }
    public static function getPrimaryPaymentMethod($workspace) {
      return "Credit Card";
    }
    public static function getBlogURL() {
        $customizations = CustomizationsKVStore::getRecord();
        return $customizations->blog_url;
    }
    public static function sendWhatsAppMessage($to, $body) {
      $creds = ApiCredentialKVStore::getRecord();
      $service = "https://graph.facebook.com";
      $path = sprintf( "/v18.0/%s/messages", $creds->whatsapp_phone_number_id);
      $headers = [
        sprintf( 'Authorization: Bearer %s', $creds->whatsapp_access_token)
      ];
      $method = "POST";
      $params = [
        "messaging_product" => "whatsapp",
        "to" => $to,
        "text" => [
          "body" => $body
        ]
        ];
      $result = WebSvcHelper::request( $service, $path, $method, $params, $headers );
      return $result;
    }
    public static function getCustomization($field) {
      $creds = CustomizationsKVStore::getRecord();
      return $creds[$field];
    }
    public static function getCredential($field) {
      $creds = ApiCredentialKVStore::getRecord();
      return $creds[$field];

    }

    // ensure input conforms to opensips format. e.g:
    // {proto}:{ip_addr}:{port}
    // examples:
    // udp:127.0.0.1:7722
    // tcp:127.0.0.1:7722
    public static function validateRTPProxyAddress($addr)  {
      $parts = explode(":", $addr);
      if (count($parts)!=3) {
        return FALSE;
      }
      if ($parts[0] != 'udp' && $parts[0] != 'tcp') {
        return FALSE;
      }

      if (!is_numeric($parts[2])) {
        return FALSE;
      }

      return TRUE;
    }
    public static function createHumanReadableDate($date) {
      // Format the date into a human-readable string
      $readableDate = $date->format('l, F j, Y g:i A');

      // Output the formatted date
      return $readableDate;
    }

    public static function numTicketsOpen() {
      $ticketsOpen = SupportTicket::where('status', 'OPEN')->count();
      return $ticketsOpen;
    }
}
