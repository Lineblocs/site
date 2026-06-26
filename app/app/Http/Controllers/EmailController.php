<?php

namespace App\Http\Controllers;

use App\Article;
use App\PhotoAlbum;
use App\SIPCountry;
use App\SIPRegion;
use App\UserEmailOption;
use App\SystemStatusCategory;
use App\SystemStatusUpdate;
use App\User;
use App\ServicePlan;
use App\Customizations;
use App\ApiCredential;
use App\WorkspaceUser;
use App\Helpers\EmailHelper;
use App\Faq;
use App\CompanyRepresentative;
use DB;
use View;
use Illuminate\Http\Request;
use Config;
use Mail;
use App\Helpers\MainHelper;
use \ReCaptcha\ReCaptcha;

class EmailController extends BaseController {

  private function createOption($key, $optionsRecord) {

    $labelKey = str_replace("email_mute_", "", $key);
    return [
      'name' => $key,
      'label' => str_replace("_", " ", ucwords($labelKey)),
      'enabled' => $optionsRecord->{$key}
    ];
  }
  /**
   * Show email unsubscribe options page.
   *
   * @return Response
   */
  public function unsubscribe(Request $request)
  {
    $token = $request->query('token');
    $user = User::where('unsubscribe_token', $token)->first();
    
    $emailOptions = [
      'email_mute_auditing' => $this->createOption('email_mute_auditing', $user),
      'email_mute_account_changes' => $this->createOption('email_mute_account_changes', $user),
      'email_mute_workspace_changes' => $this->createOption('email_mute_workspace_changes', $user),
      'email_mute_system_status_updates' => $this->createOption('email_mute_system_status_updates', $user),
      'email_mute_debugger' => $this->createOption('email_mute_debugger', $user)
    ];
    
    return view('pages.email_unsubscribe', compact('user', 'emailOptions'));
  }

  public function unsubscribe_update(Request $request)
  {
    // todo: get user from jwt token
    $token = $request->query('token');
    $user = User::where('unsubscribe_token', $token)->first();
    $updatedOptions = $this->processEmailOptions( $request->all() );
    $user->update( $updatedOptions );
    $request->session()->flash('status', 'Email options were updated successfully.');
    return redirect("/email/unsubscribe");
  }

  private function processEmailOptions( $data ) {
    $output = [
      'auditing' => FALSE,
      'account_changes' => FALSE,
      'workspace_changes' => FALSE,
      'system_status_updates' => FALSE,
      'debugger' => FALSE
    ];
    foreach ( $output as $key => $value ) {
      if (isset($data[$key]) && $data[$key]) {
        $output[$key] = true;
      }
    }
    return $output;
  }


}