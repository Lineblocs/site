<?php
namespace App\Helpers;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\DIDNumber;
use App\Extension;
use App\Workspace;
use App\Flow;
use App\FlowTemplate;
use App\ExtensionCode;
use Config;
use Auth;
use DB;

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
use App\CallRate;
use App\CallRateDialPrefix;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Mail;


final class MainHelper {
  public static function createApiId($prefix="") {
    $uuid4 = Uuid::uuid4(); 
    return sprintf("%s-%s",$prefix, $uuid4->toString());
  }
  public static function toDollars($cents) {
    return number_format(($cents /100), 2, '.', ' ');
  }
  public static function toCents($dollars) {
    $cents = \bcmul($dollars, 100);
    return  $cents;
  }
  public static function formatNumber($number, $places=2) {
      return number_format((float)$number, $places, '.', '');
  }
  public static function checkLimit($user, $type) {
    $limits = $user->getLimits();
    if ($type == "numbers") {
        $count = DIDNumber::where('user_id', '=', $user->id)->count();
        if ($count >= $limits['numbers']) {
          return TRUE;
        }
    } elseif ($type == "extensions") {
        $count = Extension::where('user_id', '=', $user->id)->count();
        if ($count >= $limits['extensions']) {
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

    $config = Config::get("paypal");
    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $config['client_id'],
            $config['client_secret']
        )
    );
    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration
    $apiContext->setConfig(
        array(
            'mode' => $config['mode'],
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
      $info = User::where('admin', '=', '0')->whereNotNull('reserved_ip')->get();
      $mothernode = Config::get("mothernodes");
      $info = $mothernode['regions'][$region]['options'][0];
      $proxy= $mothernode['regions'][$region]['proxy'];
      return array(
          "region" => $region,
          "main" => $info,
          "proxy" => $proxy,
          "reservedInfo" => $info['hosts'][0]
       );
      return FALSE;
  }
  public static function reservedIPsForHost() {
      $data = array();
      $info = User::where('admin', '=', '0')->whereNotNull('region')->get();
      $config = Config::get("mothernodes");
      foreach ($info as $item) {
        $workspace = Workspace::where('creator_id', '=', $item->id)->first();
        if ($workspace) {
          $region = $config['regions'][$item->region];
          $data[] = [
            'user' => $item,
            'workspace' => $workspace,
            'proxy_ip' => $region['proxy']['publicIp']
          ];
        }
      }
      return $data;
  }
  public static function getPublicConfig()
    {
        $data = [];
        $data['stripe'] = [];
        $data['stripe']['key'] = Config::get("stripe.public_key");
        return $data;
    }

    public static function createUserWithoutStripe($data, $needsPasswordSet=FALSE) {
        $verifiedHash = MainHelper::emailVerifyHash($data['email']);
        $password = uniqid(TRUE);
        if (isset($data['password'])) {
          $password = $data['password'];
        }
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
          'rtp_ports' => ''
        ];
        if ($needsPasswordSet) {
          $params['needs_password_set'] = $needsPasswordSet;
          $now = new \DateTime();
          $params['needs_set_password_date'] = $now->format("Y-m-d H:i:s");
        }
        $user = User::create($params);
        return $user;
    }
  public static function createUser($data) {
      $key = Config::get("stripe.secret_key");
        \Stripe\Stripe::setApiKey($key);

        $container = uniqid(TRUE);
        $customer = \Stripe\Customer::create([
          "description" => "Customer for " . $data['email']
        ]);
        $verifiedHash = MainHelper::emailVerifyHash($data['email']);
        $user = MainHelper::createUserWithoutStripe($data);
       
          $key = Config::get("stripe.secret_key");
        \Stripe\Stripe::setApiKey($key);

        $customer = \Stripe\Customer::create([
          "description" => "Customer for " . $data['email']
        ]);
        $user->update(['stripe_id' => $customer->id]);
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
      $compile = file_get_contents(public_path("/typescript/defs.ts"));
      $compile .= "\r\n" .  $content;
      \Log::info("compiling: " . $compile);
       $tmpfname = tempnam("/tmp", "FOO").".ts";
      
      $fh = fopen($tmpfname, "w");
      \Log::info("comping file " . $tmpfname);
      fwrite($fh, $compile);
      fclose($fh);
      exec("/usr/local/bin/tsc $tmpfname --outFile /dev/stdout --lib es2015", $output, $return);
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
      $template = FlowTemplate::where('name', $item['template'])->firstOrFail();
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
        echo var_dump($args);
        if ($flow->name == $args['flow_name']) {
          $args['flow_id'] = $flow->id;
          unset($args['flow_name']);
          $code = ExtensionCode::create($args);
          break;
        }
      }
}

    $extensions = Extension::where('workspace_id', '=', $workspace->id)->get()->toArray();
    $status = PBXServerHelper::provision($user, $workspace, $extensions);
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
      $password = $generator->generatePasswords(1);
      return $password[0];
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
      return [
              'auth' => $token,
              'expire_in' => \Carbon\Carbon::now()->addMinutes(config('jwt.ttl'))->format('Y-m-d H:i:s')
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
              $message->to("matrix.nad@gmail.com");
              $subject = sprintf("Lineblocs System Alert - %s", $update->title);
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
}
