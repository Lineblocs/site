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
    return [
      'name' => $key,
      'label' => str_replace("_", " ", ucwords($key)),
      'enabled' => $optionsRecord->{$key}
    ];
  }
  /**
   * Show the application dashboard to the user.
   *
   * @return Response
   */
  public function unsubscribe()
  {
    // todo: get user from jwt token
    //$user = WorkspaceUser::user();
    $user = WorkspaceUser::all()[0];
    $optionsRecord = UserEmailOption::where('user_id', $user->id)->first();
    $emailOptions = [
      'auditing' => $this->createOption('auditing', $optionsRecord),
      'account_changes' => $this->createOption('account_changes', $optionsRecord),
      'workspace_changes' => $this->createOption('workspace_changes', $optionsRecord),
      'system_status_updates' => $this->createOption('system_status_updates', $optionsRecord),
      'debugger' => $this->createOption('debugger', $optionsRecord)
    ];
    return view('pages.email_unsubscribe', compact('user', 'emailOptions'));
  }

  public function unsubscribe_update(Request $request)
  {
    // todo: get user from jwt token
    //$user = WorkspaceUser::user();
    $user = WorkspaceUser::all()[0];
    $emailOptions = UserEmailOption::where('user_id', $user->id)->first();
    $updatedOptions = $this->processEmailOptions( $request->all() );
    $emailOptions->update( $updatedOptions );
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