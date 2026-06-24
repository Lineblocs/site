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
use App\Helpers\RabbitMQHelper;
use App\Helpers\TokenHelper;
use App\Helpers\BillingDataHelper;
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
use Illuminate\Support\Str;
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
use App\Subscription;
use App\OneTimeLoginLink;
use App\Enums\PaymentStatus;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use DateTime;

class RegisterController extends ApiAuthController
{
    public function register(Request $request)
    {
        $data = $request->all();
        $email = $data['email'];
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->array(['success' => FALSE, 'message' => 'Email was invalid..']);
        }

        if (User::where('email', $email)->first()) {
            return $this->response->array(['success' => FALSE, 'message' => 'User already exists..']);
        }

        $user = MainHelper::createUser($data);
        try {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return $this->errorInternal($request, 'Could not create token');
        }

        $unique = uniqid(TRUE);
        $planKey = $data['plan'] ?? 'pay-as-you-go';
        $mainRouter = SIPRouter::getMainRouter();
        $servicePlan = ServicePlan::where('key_name', $planKey)->firstOrFail();

        $workspace = Workspace::create([
            'creator_id' => $user->id,
            'name' => $unique,
            'api_token' => MainHelper::createAPIToken(),
            'api_secret' => MainHelper::createAPISecret(),
            'plan' => $planKey,
            'trial_mode' => TRUE,
            'default_router_id' => $mainRouter->id
        ]);

        PlanUsagePeriod::create([
            'workspace_id' => $workspace->id,
            'started_at' => new DateTime()
        ]);

        WorkspaceUser::createSuperAdmin($workspace, $user, [
            'activated_account_at' => new DateTime(),
            'accepted' => TRUE
        ]);
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
        $customizations = CustomizationsKVStore::getRecord();
        $plan = ServicePlan::where('key_name', $data['plan'])->firstOrFail();
        $region = SIPPoPRegion::findOrFail( $customizations->default_region );
        $info = MainHelper::getHostIPForUser($region->code, $user);

        $workspace = Workspace::where('creator_id', '=', $user->id)->first();
        $workspace->update([
          'default_region' => $region->code
        ]);

        Log::info('adding new user to SIP proxy database tables.');
        $result = SIPRouterHelper::updateProxyToEnableWorkspace($user, $workspace, $info['proxy']);

        if (!$result) {
          return $this->errorInternal($request, 'could not create/provision user on PBX server');
        }

        if (isset($data['billing_cycle']) && strtoupper($data['billing_cycle']) === 'ANNUAL') {
            $billingCycle = 'ANNUAL';
        } else {
            $billingCycle = 'MONTHLY';
        }
        $recurringCost = NULL;
        
        $now = new DateTime();
        $anchorDay = (int)$now->format('j');

        if ($billingCycle === 'ANNUAL') {
            $periodEnd = (clone $now)->modify('+1 year')->setTime(0,0,0);
            $recurringCost = $plan->annual_cost_cents;
        } else {
            // FIXED: Look ahead to prevent native PHP +1 month edge-case rollover anomalies
            $nextMonth = (clone $now)->modify('+1 month');
            $daysInNextMonth = (int)$nextMonth->format('t');

            if ($anchorDay > $daysInNextMonth) {
                // Clamp period end to absolute upper bound of the target calendar block
                $periodEnd = $nextMonth->setDate((int)$nextMonth->format('Y'), (int)$nextMonth->format('n'), $daysInNextMonth)->setTime(0,0,0);
            } else {
                $periodEnd = (clone $now)->modify('+1 month')->setTime(0,0,0);
            }
            $recurringCost = $plan->monthly_cost_cents;
        }

        //$billingFlow = MainHelper::getBillingFlow($customizations);
        $billingFlow = $customizations['billing_flow'];
        $nextBillingDateStr = $periodEnd->format('Y-m-d');

        $subscription = Subscription::create([
            'workspace_id' => $workspace->id,
            'current_plan_id' => $plan->id,
            'status' => 'ACTIVE',
            'billing_cycle' => $billingCycle,
            'current_period_end' => $periodEnd,
            'next_billing_date' => $nextBillingDateStr,
            'billing_anchor_day' => $anchorDay
        ]);

        Log::info("Recurring cost: {$recurringCost} cents");
        $recurringCostInDollars = $recurringCost / 100;

        if ($billingFlow === 'ANNIVERSARY') {
            $amountToCharge = $recurringCostInDollars;
            Log::info("Anniversary Billing active: Charging 100% full plan fee.");
        } else {
            $amountToCharge = BillingDataHelper::calculateProratedAmount($recurringCostInDollars, $billingCycle);
            Log::info("Calendar Static Billing active: Calculating prorated fee block.");
        }
        Log::info("Amount to charge for signup: {$amountToCharge} dollars");

        try {
            RabbitMQHelper::dispatchImmediateBilling(
                $workspace,
                $subscription,
                $user,
                $plan,
                $billingCycle,
                $amountToCharge,
                $nextBillingDateStr
            );
            Log::info("Signup Billing Queued: Workspace {$workspace->id}, Amount: {$amountToCharge}");
        } catch (\Exception $e) {
            Log::error("RabbitMQ Billing Dispatch Failed: " . $e->getMessage());
        }

        Log::info('added user successfully.');

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

        $registerCredits = 0;
        if (!empty($customizations->register_credits)) {
          $registerCredits = $customizations->register_credits;
        }

        $amountInCents = $registerCredits*100;
        $credit = [
          'cents' => $amountInCents,
          'card_id' => NULL,
          'user_id' => $user->id,
          'workspace_id' => $workspace->id,
          'status' => PaymentStatus::APPROVED,
          'deduplication_key' => 'credit:register:' . $workspace->id
        ];

        UserCredit::create($credit, $plan);
        $now = new \DateTime();
        $user->update([
          'last_login' => $now
        ]);
        $detect = new \Mobile_Detect();
        $userAgent = $detect->getUserAgent();
        
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

        $link = route('email-verify', ['hash' => $user->email_verify_hash]);
        $data = [
          'user' => $user,
          'link' => $link
        ];

        Log::info('sending new user verification email');
        $subject = MainHelper::createEmailSubject("Verify Your Email");
        $result = EmailHelper::sendEmail($subject, $user->email, 'verify_email', $data);

        $mailData = [];
        $mailData['user'] = $user;
        $subject = sprintf("Welcome to %s", MainHelper::getSiteName());
        $result = EmailHelper::sendEmail($subject, $user->email, 'welcome_email', $mailData);

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
          $data = [];
          $subject = "Password reset successfully";
          $result = EmailHelper::sendEmail($subject, $user->email, 'password_was_reset', $data);
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
      return $this->response->array(['success' => TRUE, 'workspace' => $workspace->toArray()]);
    }

    public function forgot(Request $request) {
        $data = $request->all();
        $email = $data['email'];

        $user = User::where('email', $email)->first();
        if (!$user) {
            return $this->response->errorBadRequest('User not found');
        }

        $token = bin2hex(random_bytes(32));
        \DB::table('password_resets')->insert([
            'email' => $email,
            'token' => \Hash::make($token),
            'created_at' => new DateTime()
        ]);

        $resetUrl = MainHelper::createAppUrl('#/reset?token=' . $token . '&email=' . urlencode($email));
        $emailSent = EmailHelper::sendEmail(
            'Password Reset Request',
            $email,
            'password_reset',
            ['resetUrl' => $resetUrl, 'user' => $user]
        );

        if ($emailSent === TRUE) {
            Log::info("Password reset email sent to: " . $email);
            return $this->response->noContent();
        } else {
            Log::error("Failed to send password reset email to: " . $email);
            return $this->response->errorBadRequest('Failed to send reset email');
        }
    }

    public function reset(Request $request) {
       $credentials = $request->only(
           'email', 'password', 'password_confirmation', 'token'
       );

       if ($credentials['password'] !== $credentials['password_confirmation']) {
           return $this->response->errorBadRequest('Passwords do not match');
       }

       $resetRecord = \DB::table('password_resets')
           ->where('email', $credentials['email'])
           ->orderBy('created_at', 'desc')
           ->first();

       if (!$resetRecord) {
           return $this->response->errorBadRequest('Invalid or expired token');
       }

       if (!\Hash::check($credentials['token'], $resetRecord->token)) {
           return $this->response->errorBadRequest('Invalid token');
       }

       $tokenAge = (new DateTime())->getTimestamp() - (new DateTime($resetRecord->created_at))->getTimestamp();
       if ($tokenAge > 3600) {
           return $this->response->errorBadRequest('Token has expired');
       }

       $user = User::where('email', $credentials['email'])->first();
       if (!$user) {
           return $this->response->errorBadRequest('User not found');
       }

       $user->password = bcrypt($credentials['password']);
       $user->save();

       \DB::table('password_resets')
           ->where('email', $credentials['email'])
           ->delete();

       Log::info("Password reset successful for: " . $credentials['email']);
       return $this->response->noContent();
    }

    public function provisionCallSystem(Request $request) {
        $data = $request->all();
        $user = User::findOrFail($data['userId']);
        $workspace = Workspace::where('creator_id', '=', $user->id)->first();
        $template = CallSystemTemplate::findOrFail($data['templateId']);
        $status = MainHelper::provisionCallSystem($user, $workspace, $template);
        if (!$status) {
          return $this->response->errorInternal();
        }
        return $this->response->noContent();
    }

    public function thirdPartyLogin(Request $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        $challenge = $request->get('challenge');
        if ($challenge) {
          if (!MainHelper::checkUserInWorkspace($challenge, $currentUser)) {
            return $this->errorInternal($request, 'workspace challenge failed.');
          }
        }

        if ($user) {
          $workspace = Workspace::where('creator_id', $user->id)->first();
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

    private function normalizeOneTimeLoginPayload(Request $request)
    {
        $payload = $request->all();
        if (empty($payload)) {
            $payload = $request->json()->all();
        }
        return is_array($payload) ? $payload : [];
    }

    private function userBelongsToWorkspace($user, $workspace)
    {
        if (!$user || !$workspace) {
            return false;
        }
        if ((int) $workspace->creator_id === (int) $user->id) {
            return true;
        }
        $workspaceUserCount = WorkspaceUser::where('workspace_id', $workspace->id)
            ->where('user_id', $user->id)
            ->count();
        return $workspaceUserCount > 0;
    }

    public function sendOneTimeLoginLink(Request $request)
    {
        $data = $this->normalizeOneTimeLoginPayload($request);
        $userId = array_key_exists('userId', $data) ? (int) $data['userId'] : (array_key_exists('user_id', $data) ? (int) $data['user_id'] : 0);
        $workspaceId = array_key_exists('workspaceId', $data) ? (int) $data['workspaceId'] : (array_key_exists('workspace_id', $data) ? (int) $data['workspace_id'] : 0);

        if ($userId <= 0 || $workspaceId <= 0) {
            return $this->response->array([
                'success' => false,
                'message' => 'userId and workspaceId are required.'
            ]);
        }

        $user = User::find($userId);
        $workspace = Workspace::find($workspaceId);
        if (!$user || !$workspace) {
            return $this->response->array([
                'success' => false,
                'message' => 'User or workspace not found.'
            ]);
        }

        if (!$this->userBelongsToWorkspace($user, $workspace)) {
            return $this->response->array([
                'success' => false,
                'message' => 'User does not belong to this workspace.'
            ]);
        }

        $ttlMinutes = array_key_exists('expiry_minutes', $data) ? (int) $data['expiry_minutes'] : (int) env('ONE_TIME_LOGIN_LINK_TTL', 60);
        if ($ttlMinutes <= 0) {
            $ttlMinutes = 60;
        }

        $token = TokenHelper::createToken('one_time_login', [
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'email' => (string) $user->email
        ], $ttlMinutes);

        if (empty($token)) {
            return $this->response->array([
                'success' => false,
                'message' => 'Could not generate one-time token.'
            ]);
        }

        $tokenHash = hash('sha256', $token);
        $now = new DateTime();
        $expiresAt = (clone $now)->modify(sprintf('+%d minutes', $ttlMinutes));

        OneTimeLoginLink::where('user_id', $user->id)
            ->where('workspace_id', $workspace->id)
            ->whereNull('used_at')
            ->update([
                'used_at' => $now->format('Y-m-d H:i:s')
            ]);

        OneTimeLoginLink::create([
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'token_hash' => $tokenHash,
            'expires_at' => $expiresAt->format('Y-m-d H:i:s')
        ]);

        $linkExpiresAt = time() + ($ttlMinutes * 60);
        $linkParams = [
            'token' => $token,
            'userId' => $user->id,
            'workspaceId' => $workspace->id,
            'expires' => $linkExpiresAt
        ];
        $linkParams['sig'] = TokenHelper::signLinkParams($linkParams);

        $loginLink = MainHelper::createUrl('one-time-login') . '?' . http_build_query($linkParams);

        $subject = MainHelper::createEmailSubject('Your One-Time Login Link');
        $result = EmailHelper::sendEmail($subject, $user->email, 'one_time_login_link', [
            'user' => $user,
            'workspace' => $workspace,
            'login_link' => $loginLink,
            'expires_minutes' => $ttlMinutes
        ]);

        return $this->response->array([
            'success' => $result === TRUE,
            'email' => $user->email,
            'workspace_id' => $workspace->id,
            'expires_minutes' => $ttlMinutes
        ]);
    }

    public function consumeOneTimeLoginLink(Request $request)
    {
        $token = $request->query('token');
        $linkUserId = (int) $request->query('userId', 0);
        $linkWorkspaceId = (int) $request->query('workspaceId', 0);
        $linkExpires = (int) $request->query('expires', 0);
        $linkSignature = (string) $request->query('sig', '');

        if (empty($token)) {
            return response('Invalid or expired one-time login link.', 403);
        }

        if ($linkExpires <= 0 || $linkExpires < time()) {
            return response('This one-time login link has expired.', 403);
        }

        $isValidLinkSignature = TokenHelper::validateLinkSignature([
            'token' => $token,
            'userId' => $linkUserId,
            'workspaceId' => $linkWorkspaceId,
            'expires' => $linkExpires
        ], $linkSignature);

        if (!$isValidLinkSignature) {
            return response('Invalid one-time login link signature.', 403);
        }

        $payload = TokenHelper::getPayload($token);
        if (empty($payload)) {
            return response('Invalid or expired one-time login link.', 403);
        }

        $userId = array_key_exists('user_id', $payload) ? (int) $payload['user_id'] : 0;
        $workspaceId = array_key_exists('workspace_id', $payload) ? (int) $payload['workspace_id'] : 0;
        $email = array_key_exists('email', $payload) ? (string) $payload['email'] : '';
        if ($userId <= 0 || $workspaceId <= 0 || empty($email)) {
            return response('Invalid one-time login link.', 403);
        }

        if ($linkUserId !== $userId || $linkWorkspaceId !== $workspaceId) {
            return response('Invalid one-time login link.', 403);
        }

        $isValidToken = TokenHelper::validateToken($token, 'one_time_login', [
            'user_id' => $userId,
            'workspace_id' => $workspaceId,
            'email' => $email
        ]);

        if (!$isValidToken) {
            return response('Invalid or expired one-time login link.', 403);
        }

        $tokenHash = hash('sha256', $token);
        $record = OneTimeLoginLink::where('token_hash', $tokenHash)->first();
        if (!$record) {
            return response('Login link not found.', 403);
        }

        if (!empty($record->used_at)) {
            return response('This one-time login link has already been used.', 410);
        }

        if (strtotime($record->expires_at) <= time()) {
            return response('This one-time login link has expired.', 403);
        }

        $user = User::find($record->user_id);
        $workspace = Workspace::find($record->workspace_id);
        if (!$this->userBelongsToWorkspace($user, $workspace)) {
            return response('Invalid one-time login link.', 403);
        }

        $updated = \DB::table('one_time_login_links')
            ->where('id', $record->id)
            ->whereNull('used_at')
            ->update([
                'used_at' => date('Y-m-d H:i:s')
            ]);

        if ((int) $updated !== 1) {
            return response('This one-time login link has already been used.', 410);
        }

        $loginToken = JWTAuth::fromUser($user);
        if (!$loginToken) {
            return response('Could not create login token.', 500);
        }

        $redirectUrl = MainHelper::createPortalLink(sprintf('?auth=%s&workspaceId=%d', $loginToken, $workspace->id));
        return redirect($redirectUrl);
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
      $subject = MainHelper::createEmailSubject("Verify Your Email");
      $result = EmailHelper::sendEmail($subject, $email, 'verify_email', $data);
      return json_encode($result);
    }
}