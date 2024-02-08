<?php 
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Helpers\MainHelper;
use App\Helpers\BillingDataHelper;
use App\UserCredit;
use App\UserDebit;
use App\UserInvoice;
use App\Recording;
use App\Workspace;
use App\WorkspaceUser;
use Log;
use DateTime;
use DateInterval;
use NumberFormatter;
use Config;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $guarded  = array();
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $casts = array(
      "auto_recharge" => "boolean",
      "ip_whitelist_disabled" => "boolean",
      "invoices_by_email" => "boolean",
      "admin" => "boolean",
      "free_trial_started" => "date",
      "enable_2fa" => "boolean",
      "confirmed" => "boolean"
    );
    public function getSIPURL() {
      //return sprintf("%s:%s", $this->ip_address, $this->sip_port);
      return MainHelper::createSubdomainUrl($this->container_name, "");
    }
    public function canBuyNumber($workspace, $user, $number, $cost) {
      $limit = MainHelper::checkLimit($workspace, $user, "numbers");
      if ($limit) {
        if ($workspace->trial_mode) {
          return array(FALSE, "Trial accounts cannot buy more than 1 number");
        } else {
          return array(FALSE, "Cannot purchase more numbers under this plan");
        }
      }
      $balance = BillingDataHelper::getBillingInfo();
      if ($balance['remainingBalance']<=$cost && $workspace->plan == 'pay-as-you-go') {
        return array(FALSE, "Your remaining balance is below the number's monthly cost");
      }
      return array(TRUE, "");
    }
    public function toArray($allData=FALSE) {
        $array = parent::toArray();
        if (!$allData) {
          return $array;
        }

        $array['free_trial_status'] = $this->checkFreeTrialStatus();
        // data was not fully queried
        //if (!isset($array['reserved_ip'])) {
          //return $array;
        //}
        $recordings = Recording::where('user_id', $this->id)->sum('size');

        $array['recordings_space'] = $recordings;

        $array['recordings_space_mb'] = $recordings / pow(1024,2);
        //$array['pbx_ip'] = sprintf("%s:%s", $array['reserved_ip'], $array['sip_port']);
        $headers = getallheaders();
        if (isset($headers['X-Workspace-ID'])) {
          $id = $headers['X-Workspace-ID'];
          $workspace = Workspace::find($id);
          $domain = MainHelper::createSubdomain($workspace->name);
          $array['sip_url'] = $domain;
          $array['domain'] = $domain;
        }
        //$array['proxy'] = sprintf("proxy_%s", $array['container_name']);
      return $array;
      }
    public function checkFreeTrialStatus() {
      if ( $this->plan == 'trial') {
          $now = new DateTime();
          $expires =clone $this->free_trial_started;
          $expires->add(new DateInterval('P10D'));
          if ($expires->getTimestamp()<=$now->getTimestamp()) {
            return 'expired';
         }
          return 'pending-expiry';
        }
      return 'not-applicable';
    }

    public function getLimits($plan=NULL) {
      $work = \App\Workspace::where('creator_id', $this->id)->first();

      if ( $work ) {
        // FIXME: need to add better handling for database I/O
        if (!empty($plan)) {
            return $plan;
        }

        Log::info(sprintf("looking up service plan key_name = %s", $work->plan));
        $plan = ServicePlan::where('key_name', $work->plan)->firstOrFail()->toArray();
        return $plan;
      } else {
        return [
          'call_duration' => 'N/A',
          'recording_space' => 'N/A',
        ];
      }
    }
    public function getName() {
      return sprintf("%s %s", $this->first_name, $this->last_name);
    }

  public static function getAdminRecord() {
    return User::where('admin', '1')->firstOrFail();
  }
  public function getDefaultWorkspace() {
    $created = Workspace::where('creator_id', $this->id)->first();
    if ( $created ) {
      return $created;
    }
    $workspaces = Workspace::select(array('workspaces.*', 'workspaces_users.user_id'));
    $workspaces->join('workspaces_users', 'workspaces_users.workspace_id', '=', 'workspaces.id');
    $workspaces->where('workspaces_users.user_id', $this->id);
    $workspaces = $workspaces->get();
    //TODO find better way to get the most relevant workspace.
    // for now this just gets the first match
    if ( count( $workspaces ) > 0) {
      $workspace = $workspaces[0];
      return $workspace;
    }
    // no workspace exists anymore ? try to look into this error
    return NULL;
  }
}
