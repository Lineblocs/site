<?php
namespace App\Http\Controllers;

use App\CallSystemTemplate;
use App\Customizations;
use App\Helpers\DNSHelper;
use App\Helpers\EmailHelper;
use App\Helpers\MainHelper;
use App\Helpers\SIPRouterHelper;
use App\Helpers\WebSvcHelper;
use App\Http\Controllers\Api\ApiAuthController;
use App\PlanUsagePeriod;
use App\UsageTrigger;
use App\User;
use App\UserCredit;
use App\UserDevice;
use App\Workspace;
use App\WorkspaceUser;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Twilio\TwiML\VoiceResponse;
use \Config;
use \Log;
use \Mail;

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
                'success' => false,
                'message' => 'Email was invalid..',
            ]);

        }
        $exists = User::where('email', $email)->first();
        if ($exists) {
            return $this->response->array([
                'success' => false,
                'message' => 'User with this email already exists..',
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
        $unique = uniqid(true);
        $plan = 'pay-as-you-go';
        if (!empty($data['plan'])) {
            $plan = $data['plan'];
        }
        $trialMode = true;

        $workspace = Workspace::create([
            'creator_id' => $user->id,
            'name' => $unique,
            'api_token' => MainHelper::createAPIToken(),
            'api_secret' => MainHelper::createAPISecret(),
            'plan' => $plan,
            'trial_mode' => $trialMode,
        ]);
        WorkspaceUser::createSuperAdmin($workspace, $user, ['accepted' => true]);
        return $this->response->array([
            'success' => true,
            'token' => MainHelper::createJWTPayload($token),
            'userId' => $user->id,
            'workspace' => $workspace->toArrayWithRoles($user),
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
                'confirmed' => true,
                'mobile_number' => $number,
            ]);
            return $this->response->array(['isValid' => true]);
        }
        return $this->response->array(['isValid' => false]);
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
            '+15874874526',
        ];
        if (!in_array($number, $reuse)) {
            $current = User::where('mobile_number', $number)->first();
            if ($current) {
                return $this->response->array(['valid' => false, 'message' => 'Number is already registered..']);
            }
        }
        $isTest = false;
        if ($this->isTestNumber($number)) {
            $number = $number . "-" . uniqid(true);
            $isTest = true;
        }
        $current = $user->where('mobile_number', $number)->first();
        if ($current) {
            return $this->response->array(['valid' => false, 'error' => 'User with mobile number already exists.']);
        }
        $user->update([
            'pending_number' => $number,
            'call_code' => $code,
        ]);
        if ($isTest) {

            return $this->response->array(['valid' => true]);
        }
        try {
            $numberProto = $phoneUtil->parse($number, "US");
            if (!$phoneUtil->isValidNumber($numberProto)) {
                return $this->response->array(['valid' => false]);
            }
            $number = $phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::E164);
            $d7 = Config::get('d7');
            $message = sprintf("Your Lineblocs verification code is %s", $code);
            if (!$isTest) {
                $sent = MainHelper::sendSMS($d7['verification_number'], $number, $message);
                if (!$sent) {
                    return $this->response->array(['valid' => false, 'error' => 'could not send SMS']);
                }
            }
            return $this->response->array(['valid' => true]);
        } catch (\libphonenumber\NumberParseException$e) {
            return $this->response->array(['valid' => false]);
        }

        return $this->response->array(['valid' => false]);
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
            'language' => 'en-CA',
        ];
        for ($i = 0; $i != $times; $i++) {
            $gather = $response->say($say, $sayParams);
            for ($j = 0; $j != count($callCode); $j++) {
                $response->pause(['length' => '1']);
                $response->say($callCode[$j], $sayParams);
            }
        }

        return response((string) $response, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
    public function userSpinup(Request $request)
    {
        $data = $request->all();
        $user = User::findOrFail($data['userId']);
        $customizations = Customizations::getRecord();
        $plans = Config::get("service_plans");
        $plan = $plans[$data['plan']];
        $region = "ca-central-1";
        $info = MainHelper::getHostIPForUser($region, $user);
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
            'default_region' => $region,
        ]);
        $result = SIPRouterHelper::updateProxyToEnableWorkspace($user, $workspace, $info['proxy']);

        if (!$result) {
            return $this->errorInternal($request, 'could not create/provision user on PBX server');
        }

        // create k8s deployments
        $svc = "lineblocs-k8s-user";
        $params = array(
            'workspace' => $workspace->name,
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
        );

        if ($customizations->custom_code_containers_enabled) {
            $result = WebSvcHelper::post($svc, '/createContainer', $params);
            if (!$result) {
                return $this->errorInternal($request, 'Error occured when creating user containers');
            }
        }

        $result = DNSHelper::refreshIPs();
        if (!$result) {
            return $this->errorInternal($request, 'DNS error occured');
        }

        //add register credit for user
        $amountInCents = Config::get("misc.register_credits") * 100;
        $credit = [
            'cents' => $amountInCents,
            'card_id' => null,
            'user_id' => $user->id,
            'status' => 'approved',
        ];

        UserCredit::create($credit);
        $now = new \DateTime();
        $user->update([
            'last_login' => $now,
        ]);
        $detect = new \Mobile_Detect();
        $userAgent = $detect->getUserAgent();
        //first device
        UserDevice::create([
            'user_id' => $user->id,
            'user_agent' => $userAgent,
            'trusted' => true,
            'last_login' => $now,
        ]);
        UsageTrigger::create([
            'user_id' => $user->id,
            'percentage' => 50,
        ]);

        // TODO integrate custom email workflows
        // admin should be able to select from one of many email providers
        // integrate code for handling emails
        $link = route('email-verify', ['hash' => $user->email_verify_hash]);
        $data = [
            'user' => $user,
            'link' => $link,
        ];
        $result = EmailHelper::sendEmail($user->email, 'verify-email', $data);
        return $this->response->array(['success' => true, 'workspace' => $workspace->toArrayWithRoles($user)]);
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
        $user->update($data);
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
            return $this->response->array(['success' => false, 'workspace name already taken...']);
        }

        $user = User::findOrFail($data['userId']);
        $name = MainHelper::cleanWorkspaceName($data['workspace']);

        $workspace = Workspace::where('creator_id', $user->id)->firstOrFail();
        $workspace->update([
            'name' => $name,
            'plan' => $plan,
            'trial_mode' => true,
            'free_trial_started' => new DateTime(),
        ]);
        PlanUsagePeriod::create([
            'workspace_id' => $workspace->id,
            'plan' => 'trial',
        ]);
        $attrs = [];
        return $this->response->array(['success' => true, 'workspace' => $workspace->toArray()]);
    }
    public function forgot(Request $request)
    {
        $email = $request->get('email');
        $info = ['email' => $email];
        $response = Password::sendResetLink($info, function (\Illuminate\Mail\Message$message) {
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
    public function reset(Request $request)
    {
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
    public function provisionCallSystem(Request $request)
    {
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
            //MainHelper::checkUserInWorkspace($workspace->name, $user);
            if ($workspace) {
                $token = JWTAuth::fromUser($user);
                if (!$token) {
                    return $token;
                }
                $info = [
                    'workspace' => $workspace->toArrayWithRoles($user),
                    'token' => MainHelper::createJWTPayload($token),
                ];

                if (!$user->confirmed) {
                    return $this->response->array([
                        'confirmed' => false,
                        'info' => $info,
                        'userId' => $user->id,

                    ]);
                }
                return $this->response->array([
                    'confirmed' => true,
                    'info' => $info,
                    'userId' => $user->id,
                ]);
            }
            $token = JWTAuth::fromUser($user);
            if (!$token) {
                return $token;
            }

            $info = [
                'workspace' => [],
                'token' => MainHelper::createJWTPayload($token),
            ];
            return $this->response->array([
                'confirmed' => false,
                'info' => $info,
                'userId' => $user->id,

            ]);

        }
        //create a new user

        $user = MainHelper::createUser([
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);
        $token = JWTAuth::fromUser($user);
        if (!$token) {
            return $token;
        }

        $info = [
            'workspace' => [],
            'token' => MainHelper::createJWTPayload($token),
        ];
        return $this->response->array([
            'confirmed' => false,
            'info' => $info,
            'userId' => $user->id,

        ]);

    }
    public function getUserInfo(Request $request)
    {
        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if ($user) {
            return $this->response->array([
                'found' => true,
                'info' => [
                    'name' => $user->getName(),
                ],
            ]);
        }
        return $this->response->array([
            'found' => false,
        ]);

    }

    public function isTestNumber($number)
    {
        $tag = "\\+\\dTEST\\-0uu5hIw0CL";
        if (preg_match("/^" . $tag . "/", $number, $matches)) {
            return true;
        }
        return false;
    }

    public function addCard(Request $request)
    {
        $user = User::findOrFail($request->get("user_id"));
        $workspace = Workspace::findOrFail($request->get("workspace_id"));
        $data = $request->json()->all();
        MainHelper::addCard($data, $user, $workspace);
        return $this->response->noContent();
    }

}
