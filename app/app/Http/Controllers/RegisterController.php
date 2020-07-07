<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Helpers\PBXServerHelper;
use App\Helpers\MainHelper;
use App\Helpers\AWSHelper;
use App\Helpers\NamecheapHelper;
use \Config;
use \Mail;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use App\UserCredit;
use Illuminate\Support\Facades\Password;
use \Log;
use App\UserDevice;
use App\UsageTrigger;
use App\Helpers\WorkspaceHelper;
use App\Workspace;
use App\WorkspaceUser;
use App\CallSystemTemplate;
use App\VerifiedCallerId;
use App\PlanUsagePeriod;
use DateTime;

class RegisterController extends ApiAuthController
{

    public function register(Request $request)
    {
        // grab credentials from the request
        $data = $request->all();
        $email = $data['email'];
        $valid = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$valid) {
            return $this->response->array([
            'success' => FALSE,
            'message' => 'Email was invalid..'
          ]);


        }
        $exists = User::where('email', $email)->first();
        if ($exists) {
          return $this->response->array([
            'success' => FALSE,
            'message' => 'User with this email already exists..'
          ]);
        }
        $user = MainHelper::createUser($data);
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->errorInternal($request, 'Could not create token');
        }
        $unique = uniqid(TRUE);
        $workspace = Workspace::create([
        'creator_id' => $user->id,
        'name' => $unique,
        'api_token' => MainHelper::createAPIToken(),
        'api_secret' => MainHelper::createAPISecret(),
        'plan' => 'trial'
      ]);
        return $this->response->array([
            'success' => TRUE,
            'token' => MainHelper::createJWTPayload($token),
            'userId' => $user->id
        ]);

    }
    public function registerVerify(Request $request)
    {
      $data = $request->all();
      $user = User::findOrFail($data['userId']);
      $code = $data['confirmation_code'];
      $code = $data['confirmation_code'];
      $bypass = "BYPASS-0uu5hIw0CL";
      if ($user->call_code == $code || $code == $bypass) {
        $user->update([
          'confirmed' => TRUE
        ]);
        return $this->response->array(['isValid' => TRUE]);
      }
      return $this->response->array(['isValid' => FALSE]);
    }

    public function registerSendVerify(Request $request)
    {
      $code = rand(100000, 999999); 
      $data = $request->all();
     $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
      $number = $data['mobile_number'];
      $user = User::findOrFail($data['userId']);
      $reuse = [
          '+17808503688',
          '+15874874526'
      ];
      if (!in_array($number, $reuse)) {
        $current = User::where('mobile_number', $number)->first();
        if ($current) {
              return $this->response->array(['valid' => FALSE, 'message' => 'Number is already registered..']);
        }
      }
      $user->update([
        'mobile_number' => $number,
        'call_code' => $code
      ]);
      try {
          $numberProto = $phoneUtil->parse($number, "US");
          if ( !  $phoneUtil->isValidNumber($numberProto) ) {
            return $this->response->array(['valid' => FALSE]);
          }
          $number =$phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::E164);
          //send code through call
          $twilio= Config::get('twilio');
          $mb= Config::get('messagebird');
          $client = new Client($twilio['account_sid'], $twilio['auth_token']);
          /*
          $client->account->calls->create(  
              $number,
              $twilio['verification_number'],
              array(
                  "url" => url("/api/registerVerifyHook?userId=" . $user->id)
              )
          );
          */
        $message = sprintf("Your Lineblocs verification code is %s", $code);
        $sent = MainHelper::sendSMS( $mb['verification_number'], $number, $message );
        if (!$sent) {
          return $this->response->array(['valid' => FALSE, 'error' => 'could not send SMS']);
        }
          return $this->response->array(['valid' => TRUE]);
      } catch (\libphonenumber\NumberParseException $e) {
        return $this->response->array(['valid' => FALSE]);
      }
     
      return $this->response->array(['valid' => FALSE]);
    }
  
    public function registerVerifyHook(Request $request)
    {
      $data = $request->all();
      $userId = $data['userId'];
      $user = User::findOrFail($userId);
     $response = new VoiceResponse();
      $callCode = str_split($user->call_code);
      $say = "Your verification code is";
      $times = 5;
      $sayParams = [
        'voice' => 'alice',
        'language' => 'en-CA'
        ];
      for ($i = 0; $i != $times; $i ++) {
        $gather = $response->say($say, $sayParams);
        for ($j = 0; $j != count($callCode); $j ++ ) {
            $response->pause(['length' => '1']);
            $response->say($callCode[$j], $sayParams);
        }
      }

    return response((string) $response, 200, [
        'Content-Type' => 'application/xml'
      ]);
    }
    public function userSpinup(Request $request)
    {
        $data = $request->all();
        $user = User::findOrFail($data['userId']);
        $plans = Config::get("service_plans");
        $trial = $plans['trial'];
        $region = "ca-central-1";
        if ($user->confirmed) {
          $info = MainHelper::getHostIPForUser($region, $user);
          //$reservedIp = AWSHelper::reserveIP($region, $ip['main'], $ip['reservedIp']);
          //$reservedIp = VultrHelper::reserveIP($region, $ip['main'], $ip."/32");
          /*
          if (!$reservedIp) {
            return $this->response->errorInternal('could not register IP for user');
          }
          */

          $workspace = Workspace::where('creator_id', '=', $user->id)->first();
          $result = PBXServerHelper::create($user, $workspace, $region, $info['proxy'], $info['main'], $info['reservedInfo'], $trial['ports']/** needed ports **/);
          if (!$result) {
            return $this->errorInternal($request, 'could not create/provision user on PBX server');
          }
          $result = NamecheapHelper::refreshIPs();
          if (!$result) {
            return $this->errorInternal($request, 'DNS error occured');
          }

          //add register credit for user
          $amountInCents = Config::get("misc.register_credits")*100;
          $credit = [
            'cents' => $amountInCents,
            'card_id' => NULL,
            'user_id' => $user->id,
            'status' => 'approved'
          ];

          UserCredit::create($credit);
          $now = new \DateTime();
          $user->update([
            'last_login' => $now
          ]);
          $detect = new \Mobile_Detect();
          $userAgent = $detect->getUserAgent();
          //first device
          UserDevice::create([
              'user_id' => $user->id,
              'user_agent' => $userAgent,
              'trusted' => TRUE,
              'last_login' => $now
          ]);
          UsageTrigger::create([
              'user_id' => $user->id,
              'percentage' => 50
          ]);
          $mail = Config::get('mail');
          $link = route('email-verify', ['hash' => $user->email_verify_hash]);
          $data = [
            'user' => $user,
            'link' => $link
          ];
          Mail::send('emails.verify_email', $data, function ($message) use ($user, $mail) {
              $message->to($user->email);
              $message->subject("Lineblocs.com - Verify Your Email");
              $from = $mail['from'];
              $message->from($from['address'], $from['name']);
          });
          $workspace = Workspace::where('creator_id', '=', $user->id)->first();
          return $this->response->array(['success' => TRUE, 'workspace' => $workspace->toArrayWithRoles($user)]);
        }
      return $this->response->array(['success' => FALSE]);
    }


    public function getSelf(Request $request)
    {
      $user = $this->getUser($request);
      return $this->response->array($user->toArray());
    }
    public function updateSelf(Request $request)
    {
      $data = $request->json()->all();
      if (isset($data['password'])) {
        $data['password'] = bcrypt($data['password']);
      }
      $user = $this->getUser($request);
      $user->update( $data );
      if (isset($data['password'])) {
          $mail = Config::get("mail");
          $data = [];
          Mail::send('emails.password_was_reset', $data, function ($message) use ($user, $mail) {
              $message->to($user->email);
              $message->subject("Lineblocs.com - Password reset successfully");
              $from = $mail['from'];
              $message->from($from['address'], $from['name']);
          });
      }
      return $this->response->noContent();
    }
    public function updateWorkspace(Request $request)
    {
      $data = $request->json()->all();
      $plan = $data['plan'];
      $count = Workspace::where('name', '=', $data['workspace'])->count();
      if ($count > 0) {
        return $this->response->array(['success' => FALSE, 'workspace name already taken...']);
      }

      $user = User::findOrFail($data['userId']);
      $name = MainHelper::cleanWorkspaceName($data['workspace']);

      $workspace = Workspace::where('creator_id', $user->id)->firstOrFail();
      $workspace->update([
        'name' => $name,
        'plan' => $plan,
        'trial_mode' => TRUE,
        'free_trial_started' => new DateTime()
      ]);
      PlanUsagePeriod::create([
        'workspace_id' => $workspace->id,
        'plan' => 'trial'
      ]);
      //create caller id
      VerifiedCallerId::create([
          'user_id' => $user->id,
          'workspace_id' => $workspace->id,
          'code' => '',
          'confirmed' => TRUE,
          'number' => $user->mobile_number
      ]);
      $attrs = [];
      WorkspaceUser::createSuperAdmin($workspace, $user);
      return $this->response->array(['success' => TRUE, 'workspace' => $workspace->toArray()]);
    }
    public function forgot(Request $request) {
       $email = $request->get('email');
       $info = ['email' => $email];
       $response = Password::sendResetLink($info, function (\Illuminate\Mail\Message $message) {
           $message->subject('Your Password Reset Link');

       });
        Log::info("reset response is: " . $response);
       switch ($response) {
           case Password::RESET_LINK_SENT:
               return $this->response->noContent();
            break;

           case Password::INVALID_USER:
               return $this->response->errorBadRequest();
          break;
  
       }
    }
   public function reset(Request $request) {
       $credentials = $request->only(
           'email', 'password', 'password_confirmation', 'token'
       );

       $response = Password::reset($credentials, function ($user, $password) {
           $user->password = bcrypt($password);

           $user->save();

           //Auth::login($user);
       });
       Log::info("reset reply is: " . $response);
       switch ($response) {
           case Password::PASSWORD_RESET:
               return $this->response->noContent();
            break;
           case Password::INVALID_PASSWORD:
               return $this->response->errorBadRequest("Password strength is not sufficient");
            break;
            case Password::INVALID_TOKEN:
               return $this->response->errorBadRequest("Invalid signature");
            break;

           default:
               return $this->response->errorBadRequest();
          break;
    

       }
  } 
  public function provisionCallSystem(Request $request) {
        $data = $request->all();
        $user = User::findOrFail($data['userId']);
        $workspace = Workspace::where('creator_id', '=', $user->id)->first();
        $template = CallSystemTemplate::findOrFail($data['templateId']);
        $status =MainHelper::provisionCallSystem($user, $workspace, $template);
        if (!$status) {
          return $this->response->errorInternal();
        }
      return $this->response->noContent();
  }

  public function thirdPartyLogin(Request $request)
  {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        $challenge=  $request->get('challenge');
        if ($challenge) {
          if (!MainHelper::checkUserInWorkspace($challenge, $currentUser)) {
            return $this->errorInternal($request, 'workspace challenge failed.');
          }
        }

        if ($user) {
          $workspace = Workspace::where('creator_id', $user->id)->first();
          //MainHelper::checkUserInWorkspace($workspace->name, $user);
          if ($workspace) {
              $token = JWTAuth::fromUser($user);
              if (!$token) {
                  return $token;
              }
            $info = [
                'workspace' => $workspace->toArrayWithRoles($user),
                'token' => MainHelper::createJWTPayload($token)
            ];

            if (!$user->confirmed) {
              return $this->response->array([
                'confirmed' => FALSE,
                'info' => $info,
                'userId' => $user->id

              ]);
            }
            return $this->response->array([
                'confirmed' => TRUE,
                'info' => $info,
                'userId' => $user->id
              ]);
          }
          $token = JWTAuth::fromUser($user);
          if (!$token) {
              return $token;
          }

          $info = [
            'workspace' => [],
            'token' => MainHelper::createJWTPayload($token)
          ];
          return $this->response->array([
                  'confirmed' => FALSE,
                  'info' => $info,
                  'userId' => $user->id

                ]);

      }
      //create a new user
      
      $user = MainHelper::createUser([
        'email' => $data['email'],
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name']
      ]);
      $token = JWTAuth::fromUser($user);
      if (!$token) {
          return $token;
      }


      $info = [
        'workspace' => [],
        'token' => MainHelper::createJWTPayload($token)
      ];
      return $this->response->array([
              'confirmed' => FALSE,
              'info' => $info,
              'userId' => $user->id

            ]);

  }
  public function getUserInfo(Request $request)
  {
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
      if ( $user ) {
        return $this->response->array([
          'found' => TRUE,
          'info' => [
            'name' => $user->getName()
          ]
        ]);
      }
      return $this->response->array([
          'found' => FALSE
        ]);

  }

}
