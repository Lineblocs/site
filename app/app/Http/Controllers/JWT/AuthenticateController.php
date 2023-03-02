<?php
namespace App\Http\Controllers\JWT;

use App\Helpers\MainHelper;
use App\Http\Controllers\Api\ApiAuthController;
use App\User;
use App\UserDevice;
use App\Workspace;
use Auth;
use Config;
use Illuminate\Http\Request;
use JWTAuth;
use Mail;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends ApiAuthController
{
    public function authenticatePublic(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('token', 'secret');
        $workspace = Workspace::where('api_token', $credentials['token'])->where('api_secret', $credentials['secret'])->firstOrFail();
        $user = User::findOrFail($workspace->creator_id);
        //$user = Auth::attempt($credentials);
/*
$user = User::where('email', $credentials['email'])
->first();

$validCredentials = Hash::check($credentials['password'], $user->getAuthPassword());

if (!$validCredentials) {
return $this->errorInternal();
}
 */
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = MainHelper::createJWTTokenArrFromUser($user, $workspace)) {
                return response()->json(['error' => 'could not create user'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->errorInternal($request, 'Could not create token');
        }
        // add subdomain matching
        return $this->response->array($token);

    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        //$user = Auth::attempt($credentials);
/*
$user = User::where('email', $credentials['email'])
->first();

$validCredentials = Hash::check($credentials['password'], $user->getAuthPassword());

if (!$validCredentials) {
return $this->errorInternal();
}
 */

        \Log::info("trying to authenticate user: " . $credentials['email']);
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            \Log::info("error occured: " . $e->getMessage());
            return $this->errorInternal($request, 'Could not create token');
        }
        $currentUser = Auth::user();
        $now = new \DateTime();

        $challenge = $request->get('challenge');
        if ($challenge) {
            if (!MainHelper::checkUserInWorkspace($challenge, $currentUser)) {
                return $this->errorInternal($request, 'workspace challenge failed.');

            }
        }

        $currentUser->update([
            'last_login' => $now,
        ]);
        $detect = new \Mobile_Detect();
        $userAgent = $detect->getUserAgent();
        $device = UserDevice::where('user_agent', '=', $userAgent)->where('user_id', '=', $currentUser->id)->first();
        if (!$device) {
            //non trusted device currently
            UserDevice::create([
                'user_id' => $currentUser->id,
                'user_agent' => $userAgent,
                'trusted' => false,
                'last_login' => $now,
            ]);
            $data = [
                'detect' => $detect,
                'user' => $currentUser,
            ];
            $mail = Config::get('mail');
            Mail::send('emails.unknown_device_login', $data, function ($message) use ($currentUser, $mail) {
                $message->to($currentUser->email);
                $message->subject("Lineblocs.com - Unknown Device Login");
                $from = $mail['from'];
                $message->from($from['address'], $from['name']);
            });
        }
        // add subdomain matching
        $workspace = Workspace::where('creator_id', '=', $currentUser->id)->first();
        $result = MainHelper::createWorkspaceLoginResult($token, $currentUser, $workspace);
        return $this->response->array($result);
    }
    public function heartbeat(Request $request)
    {
        return $this->response->noContent();
    }
}
