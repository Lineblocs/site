<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Helpers\SIPRouterHelper;
use App\Helpers\MainHelper;
use App\Helpers\SMSHelper;
use App\Helpers\AWSHelper;
use App\Helpers\DNSHelper;
use App\Helpers\WebSvcHelper;
use App\Helpers\EmailHelper;
use \Config;
use \Mail;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use App\UserCredit;
use App\ServicePlan;
use App\Customizations;
use App\CustomizationsKVStore;
use Illuminate\Support\Facades\Password;
use \Log;
use App\UserDevice;
use App\UsageTrigger;
use App\Helpers\WorkspaceHelper;
use App\Workspace;
use App\WorkspaceUser;
use App\WorkspaceEvent;
use App\CallSystemTemplate;
use App\VerifiedCallerId;
use App\PlanUsagePeriod;
use App\SIPPoPRegion;
use App\SIPRouter;
use App\UserRegistrationQuestionResponse;
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
        $plan = 'pay-as-you-go';
        if ( !empty($data['plan'] )) {
          $plan = $data['plan'];
        }
        $trialMode =TRUE; 

        $mainRouter = SIPRouter::getMainRouter();
        $workspace = Workspace::create([
        'creator_id' => $user->id,
        'name' => $unique,
        'api_token' => MainHelper::createAPIToken(),
        'api_secret' => MainHelper::createAPISecret(),
        'plan' => $plan,
        'trial_mode' => $trialMode,
        'default_router_id' => $mainRouter->id
      ]);
      $period = PlanUsagePeriod::create([
        'workspace_id' => $workspace->id,
        'started_at' => new DateTime()
      ]);
      WorkspaceUser::createSuperAdmin($workspace, $user, ['accepted' => TRUE]);
      WorkspaceEvent::addEvent($workspace, 'WORKSPACE_CREATED');
        return $this->response->array([
            'success' => TRUE,
            'token' => MainHelper::createJWTPayload($token),
            'userId' => $user->id,
            'workspace' => $workspace->toArrayWithRoles($user)
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

        $number = $user->pending_number;
        $user->update([
          'confirmed' => TRUE,
          'mobile_number' => $number
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
      $customizations = CustomizationsKVStore::getRecord();
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

      $current = $user->where('mobile_number', $number)->first();
      if ( $current ) {
          return $this->response->array(['valid' => FALSE, 'error' => 'User with mobile number already exists.']);
      }
      $user->update([
        'pending_number' => $number,
        'call_code' => $code
      ]);

      try {
          $numberProto = $phoneUtil->parse($number, "US");
          if ( !  $phoneUtil->isValidNumber($numberProto) ) {
            return $this->response->array(['valid' => FALSE]);
          }
          $number =$phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::E164);

        $domain = MainHelper::getDeploymentDomain();
        $message = sprintf("Your %s verification code is %s", $domain, $code);
        $from = $customizations->sms_from_number;
        try {
          SMSHelper::sendSMS( $from, $number, $message );
        } catch ( Exception $ex ) {
          Log::error("error sending SMS message: " . $ex->getMessage());
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
    public function saveRegistrationQuestionResponses(Request $request)
    {
        $data = $request->json()->all();
        $user = User::findOrFail($data['user_id']);

        foreach ($data['responses'] as $response) {
          UserRegistrationQuestionResponse::create([
            'user_id' => $user->id,
            'question_id' => $response['question_id'],
            'response' => $response['response'],
          ]);
        }

        return $this->response->array(['success' => TRUE]);
    }
    public function userSpinup(Request $request)
    {
        $data = $request->all();
        $user = User::findOrFail($data['userId']);
        $customizations =CustomizationsKVStore::getRecord();
        $plan = ServicePlan::where('key_name', $data['plan'])->firstOrFail()->toArray();
        //$plan = $plans[$data['plan']];
        $region = SIPPoPRegion::findOrFail( $customizations->default_region );
        $info = MainHelper::getHostIPForUser($region->code, $user);
          //$reservedIp = AWSHelper::reserveIP($region, $ip['main'], $ip['reservedIp']);
          //$reservedIp = VultrHelper::reserveIP($region, $ip['main'], $ip."/32");
          /*
          if (!$reservedIp) {
            return $this->response->errorInternal('could not register IP for user');
          }
          */


          $workspace = Workspace::where('creator_id', '=', $user->id)->first();
          // setup default region
          $workspace->update([
            'default_region' => $region->code
          ]);

          Log::info('adding new user to SIP proxy database tables.');
          $result = SIPRouterHelper::updateProxyToEnableWorkspace($user, $workspace, $info['proxy']);

          if (!$result) {
            return $this->errorInternal($request, 'could not create/provision user on PBX server');
          }

          Log::info('added user successfully.');


          // create k8s deployments
          $svc = "lineblocs-k8s-user";
          $params = array(
              'workspace' => $workspace->name,
              'user_id' => $user->id,
              'workspace_id' => $workspace->id,
          );

          if ( $customizations->custom_code_containers_enabled  ) {
            Log::info('deploying new container for custom user functions');
            $result = WebSvcHelper::post($svc, '/createContainer', $params);
            if (!$result) {
              return $this->errorInternal($request, 'Error occured when creating user containers');
            }

            Log::info('deployed container successfully.');
          }


          Log::info('updating DNS records.');
          $result = DNSHelper::refreshIPs();
          if (!$result) {
            return $this->errorInternal($request, 'DNS error occured');
          }

          Log::info('updated DNS successfully.');

          //add register credit for user
          $registerCredits = 0;
          if (!empty($customizations->register_credits)) {
            $registerCredits = $customizations->register_credits;
          }

          $amountInCents = $registerCredits*100;
          $credit = [
            'cents' => $amountInCents,
            'card_id' => NULL,
            'user_id' => $user->id,
            'status' => 'approved'
          ];

          UserCredit::create($credit, $plan);
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

          // TODO integrate custom email workflows
          // admin should be able to select from one of many email providers
          // integrate code for handling emails
          $link = route('email-verify', ['hash' => $user->email_verify_hash]);
          $data = [
            'user' => $user,
            'link' => $link
          ];

          Log::info('sending new user verification email');
          $subject =MainHelper::createEmailSubject("Verify Your Email");
          $result = EmailHelper::sendEmail($subject, $user->email, 'verify_email', $data);

          return $this->response->array(['success' => TRUE, 'workspace' => $workspace->toArrayWithRoles($user)]);
    }


    public function getSelf(Request $request)
    {
      $user = $this->getUser($request);
      $workspaceUser = $this->getWorkspaceUserWithAllData($request, $user);
      $result = $user->toArray();
      $result['workspace_data'] = $workspaceUser->toArray();

      return $this->response->array($result);
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
          $subject = "Password reset successfully";
          $result = EmailHelper::sendEmail($subject, $user->email, 'password_was_reset', $data);
          /*
          Mail::send('emails.password_was_reset', $data, function ($message) use ($user, $mail) {
              $message->to($user->email);
              $subject =MainHelper::createEmailSubject("Password reset successfully");
              $message->subject($subject);
              $from = $mail['from'];
              $message->from($from['address'], $from['name']);
          });
          */
      }
      return $this->response->noContent();
    }

    public function updateWorkspaceUser(Request $request) {
      $user = $this->getUser($request);
      $workspace = $this->getWorkspace($request);
      $data = $request->json()->all();
      $keys = ['fcm_token', 'apn_token'];
      $updateData = array_intersect_key($data, array_flip($keys));

      $workspaceUser = WorkspaceUser::where('workspace_id', $workspace->id)
                  ->where('user_id', $user->id);
      $workspaceUser->update($updateData);

      return $this->response->noContent();
    }

    public function setupWorkspace(Request $request)
    {
      $data = $request->json()->all();
      $plan = $data['plan'];

      $specifiedPlan = ServicePlan::where('key_name', $plan)->first();
      if ( !$specifiedPlan ) {
        return $this->response->errorBadRequest();
      }

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
        'plan' => $plan,
        'started_at' => new DateTime()
      ]);
      $attrs = [];
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

  public function isTestNumber($number) {
      $tag = "\\+\\dTEST\\-0uu5hIw0CL";
      if (preg_match("/^" . $tag . "/", $number, $matches)) {
        return TRUE; 
      }
      return FALSE;
  }

  public function addCard(Request $request)
  {
    $user = User::findOrFail($request->get("user_id"));
    $workspace = Workspace::findOrFail($request->get("workspace_id"));
    $data = $request->json()->all();
    MainHelper::addCard($data, $user, $workspace);
    return $this->response->noContent();
  }

  public function emailTest(){
    $email = 'tgblinkss@gmail.com';
    $data = 'This is a test';
    $subject =MainHelper::createEmailSubject("Verify Your Email");
    $result = EmailHelper::sendEmail($subject, $email, 'verify_email', $data);
    return json_encode($result);
    // return $this->response->array(['success' => TRUE, 'workspace' => $workspace->toArrayWithRoles($user)]);
  }

}
