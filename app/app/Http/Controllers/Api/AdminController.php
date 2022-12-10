<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Call;
use App\UserCard;
use App\UsageTrigger;
use App\DIDNumber;
use App\CallSystemTemplate;
use App\Workspace;
use App\Transformers\WorkspaceTransformer;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\PhoneDefault;
use App\Fax;


use App\Extension;
use App\File;
use App\Flow;
use App\Recording;
use App\IpWhitelist;
use App\BlockedNumber;
use App\VerifiedCallerId;
use App\Phone;
use App\PhoneGroup;
use App\WorkspaceUser;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Helpers\SIPRouterHelper;
use App\Helpers\MainHelper;
use App\Helpers\AWSHelper;
use App\Helpers\DNSHelper;
use App\Helpers\PhoneProvisionHelper;

use App\PhoneGlobalSetting;
use App\PhoneGlobalSettingValue;
use App\PhoneIndividualSetting;
use App\PhoneIndividualSettingValue;

use \Config;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use App\UserCredit;
use DateTime;
use DateInterval;
use DB;

class AdminController extends ApiAuthController
{
    public function getWorkspaces(Request $request)
    {
      $isAdmin = $this->checkAdminAuth( $request );
      if (!$isAdmin) {
        return $this->response->errorForbidden("incorrect admin token..");
      }
      $workspaces = Workspace::all();
      return $this->response->collection($workspaces, new WorkspaceTransformer);
    }


}
