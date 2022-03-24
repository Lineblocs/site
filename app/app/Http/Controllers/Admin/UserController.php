<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Workspace;
use App\WorkspaceRoutingFlow;
use App\RouterFlow;
use App\SIPCountry;
use App\PortNumber;
use App\DIDNumber;
use App\Http\Requests\Admin\UserRequest;
use App\Helpers\MainHelper;
use App\Helpers\AdminUIHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Auth;
use Illuminate\Http\Request;

class UserController extends AdminController
{


    public function __construct()
    {
        view()->share('type', 'user');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         $countries = MainHelper::getCountries();

        return view('admin.user.create_edit', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {

        $user = new User ($request->except('password','password_confirmation'));
        $user->password = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->save();
        header("X-Goto-URL: /admin/user/" . $user->id . "/edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(User $user)
    {
        $numbers = DIDNumber::where('user_id', $user->id)->get();
        $workspaces = Workspace::select(DB::raw("workspaces.name, users.email AS creator_email"));
        $workspaces->leftJoin('workspaces_users', 'workspaces_users.workspace_id', '=', 'workspaces.id');
        $workspaces->leftJoin('users', 'users.id', '=', 'workspaces.creator_id');
        $workspaces->where('workspaces_users.user_id', '=', $user->id);
         $workspaces = $workspaces->get();

        $ports =  PortNumber::select(DB::raw("port_numbers.*"));
        $ports->leftJoin('workspaces', 'workspaces.id', '=', 'port_numbers.workspace_id');
        $ports->where('workspaces.creator_id', '=', $user->id);
         $ports = $ports->get();

        $dids =  DIDNumber::select(DB::raw("did_numbers.*"));
        $dids->leftJoin('workspaces', 'workspaces.id', '=', 'did_numbers.workspace_id');
        $dids->where('workspaces.creator_id', '=', $user->id);
         $dids = $dids->get();


         $billingHistory = MainHelper::getBillingHistory($user);
         $billingInfo = $user->getBillingInfo();
         $countries = MainHelper::getCountries();
         $cannedEmails = AdminUIHelper::getCannedEmails();
         $sipcountries = SIPCountry::select(array('sip_countries.iso', 'sip_countries.name', 'workspaces_routing_flows.flow_id', \DB::raw('workspaces_routing_flows.id AS wflow_id')));
         $sipcountries = $sipcountries->leftJoin('workspaces_routing_flows', 'workspaces_routing_flows.country_id', '=', 'sip_countries.id');
         $sipcountries = $sipcountries->get();
        return view('admin.user.create_edit', compact('user', 'numbers', 'workspaces', 'billingHistory', 'billingInfo', 'countries', 'ports', 'cannedEmails', 'dids',  'sipcountries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }
        $user->update($request->except('password','password_confirmation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(User $user)
    {
        return view('admin.user.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $users = User::select(array('users.id', 'users.first_name', 'users.last_name',  'users.email', 'users.confirmed', 'users.plan', 'users.created_at'));

        return Datatables::of($users)
            ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ url(\'admin/user/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/user/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }
   public function edit_port_req(User $user, PortNumber $port)
    {
        $statuses =[
            'pending-review' => 'Pending Review',
            'received' => 'Received',
            'needs-info' => 'Needs Info',
            'submitted-to-provider' => 'Submitted To Provider',
            'confirmed' => 'Confirmed',
            'completed' => 'Completed'
        ];
        return view('admin.user.edit_port_req', compact('user', 'port', 'statuses'));
    }
   public function edit_port_req_Do(Request $request, User $user, PortNumber $port)
    {
        $data = $request->all();
        $status = $port->status;
        if ($status != $data['status']) {
            $mail = Config::get("mail");
                $data = [
                    'user' => $user,
                    'port' => $port
                ];

            if ($status=='received') {
                Mail::send('emails.ports_status_received', $data, function ($message) use ($user, $port, $mail) {
                    $message->to($user->email);
                    $message->subject("Port Request " . $port->public_id . " received");
                    $from = $mail['from'];
                    $message->from($from['address'], $from['name']);
                });
            } elseif ($status=='submitted-to-provider') {
                Mail::send('emails.ports_status_submitted', $data, function ($message) use ($user, $port, $mail) {
                    $message->to($user->email);
                    $message->subject("Port Request " . $port->public_id . " submitted to provider");
                    $from = $mail['from'];
                    $message->from($from['address'], $from['name']);
                });
            } elseif ($status=='confirmed') {
                Mail::send('emails.ports_status_confirmed', $data, function ($message) use ($user, $port, $mail) {
                    $message->to($user->email);
                    $message->subject("Port Request " . $port->public_id . " confirmed");
                    $from = $mail['from'];
                    $message->from($from['address'], $from['name']);
                });
            } elseif ($status=='completed') {
                Mail::send('emails.ports_status_completed', $data, function ($message) use ($user, $port, $mail) {
                    $message->to($user->email);
                    $message->subject("Port Request " . $port->public_id . " completed");
                    $from = $mail['from'];
                    $message->from($from['address'], $from['name']);
                });

            } elseif ($status=='needs-info') {
                Mail::send('emails.ports_status_needs_info', $data, function ($message) use ($user, $port, $mail) {
                    $message->to($user->email);
                    $message->subject("Port Request " . $port->public_id . " needs additional info");
                    $from = $mail['from'];
                    $message->from($from['address'], $from['name']);
                });
            }
        }
        $port->update($request->all());
    }
   public function edit_did(User $user, DIDNumber $did)
    {
        return view('admin.user.edit_did', compact('user', 'did'));
    }
   public function edit_did_do(Request $request, User $user, DIDNumber $did)
    {
        $data = $request->all();
        $did->update($request->all());
    }
    private function createLBSignature($user) {

        $baseURL = Config::get("app.url")."/email-images/signature/";
        $html = <<<EOF
<table width="100%" align="center" cellspacing="0" cellpadding="0">
<style>
<!--
a:hover {
	color : #959595 ;
	text-decoration : none;
}
a.gold:link, a:visited {
	color : #959595 ;
	text-decoration : none;
}
a.gold:hover {
	color : #4c2b62 ;
	text-decoration : none;
}
-->
<!--
@import url(https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700);
-->
</style>

    <tbody><tr><td>
    <p style="border-top: 2px solid #ebfcfc; font-size:1px;">&nbsp;</p>
    	<p style="font-size:16px;color:#3f51b5;font-family:'Roboto', Verdana, Arial, Helvetica, sans-serif; font-weight:700; letter-spacing: 1px;">

          <!-- "MERRY SMIRT" replace to your full name -->
            {{admin.first_name}} {{admin.last_name}}
          <br>
      		<span style="font-size:13px;color:#4e6783 ;font-family:'Roboto', Verdana, Arial, Helvetica, sans-serif; font-weight:400; letter-spacing:0;">
          
          <!-- "Assitant Designer" replace to your title -->
          {{admin.job_title}}
          </span>
      </p>
      <p style="margin-bottom:3px;margin-top:30px;">

          <!-- "imgs/logo_s_color.png" replace with the root of the address where you put the file on the server.
          for example "http://www.yourdomain.com/signature/imgs/logo_s_color.png  -->
        	<img src="{$baseURL}/logo_s_color.png" alt="Klambi" name="klambi1" border="0" align="top" id="ridImg2">
      </p>
        
      <p style="font-size:13px;color:#959595 ;font-family:'Roboto', Verdana, Arial, Helvetica, sans-serif;margin-bottom:10px;margin-top:0px; line-height: 1.5; font-weight:400;">

          <!-- replace to your address 1 -->
      		12108 82 ST NW
          
          <br>

          <!-- replace to your address 2 -->
            Edmonton AB, Canada
          <br> 
          <a style="color: #4c2b62;">
          — </a>

          <br>
          <a style="color: #4c2b62;">
          phone.</a> &nbsp;&nbsp;: 

          <!-- " +098 776 5541 " replace to your telephone number -->
          {{admin.office_number}}
          <br>
          <a style="color: #4c2b62;">
          email. </a> &nbsp;:  

          <!-- "info@yourdomain.com" replace to your email address -->
          <a href="mailto:info@lineblocs.com" class="gold"> 

          <!-- "info@yourdomain.com" replace to your email address -->
          {{admin.email}}
          </a>
          <br>
          <a style="color: #4c2b62;">
         	website.</a> :

          <!-- "www.yourdomain.com" replace to your domain -->
          <a href="http://lineblocs.com" class="gold"> 

          <!-- "www.yourdomain.com" replace to your domain -->
          lineblocs.com
          </a>
       	  <br>
          <a style="color: #4c2b62;">
          — </a>
      </p>

      <p style="margin-top:10px;">
          <!-- " http://www.facebook.com/# " replace to your facebook id link -->
          <a href="https://www.facebook.com/lineblocs/" target="_blank"> 

          <!-- "imgs/facebook.png" replace with the root of the address where you put the file on the server.
          for example "http://www.yourdomain.com/signature/imgs/facebook.png -->
          <img id="klambi2" src="{$baseURL}/facebook.png" alt="facebook" border="0" align="top"></a>&nbsp;&nbsp;
          
          <!-- " http://www.twitter.com/# " replace to your facebook id link -->
          <a href="https://twitter.com/lineblocs" target="_blank"> 

          <!-- "imgs/twitter.png" replace with the root of the address where you put the file on the server.
          for example "http://www.yourdomain.com/signature/imgs/twitter.png -->
          <img id="klambi3" src="{$baseURL}/twitter.png" alt="twitter" border="0" align="top"></a>&nbsp;&nbsp;
          
          <!-- " http://www.linkedin.com/# " replace to your facebook id link -->
          <a href="https://ca.linkedin.com/company/lineblocs" target="_blank"> 

          <!-- "imgs/linkedin.png" replace with the root of the address where you put the file on the server.
          for example "http://www.yourdomain.com/signature/imgs/linkedin.png -->
          <img id="klambi4" src="{$baseURL}/linkedin.png" alt="linkedin" border="0" align="top"></a>&nbsp;&nbsp;
      </p>

      <p style="font-size: 11px;font-family:'Roboto', Arial, Helvetica, sans-serif;color: #cecece ;margin-top:15px;">
         	This email message is for the exclusive use of the intended recipient(s) and may contain confidential, privileged and non-disclosable information. Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact the sender by reply email immediately and destroy any and all copies of the message.
      </p>

      <p style="font-size:11px; font-family:'Roboto', Arial, Helvetica, sans-serif; color:#cecece ; margin-top:10px;">
        	<img id="klambi6" src="{$baseURL}/recycle.png" alt="recycle" border="0" align="top"> 
        	Please consider the environment before printing this email. 
      </p>

  </td>
</tr></tbody></table>
EOF;
        return $this->replaceEmailTexts($html, ['admin' => $user]);
    }
    private function replaceEmailTexts($text, $replacers=[])
    {

        $pattern = "/{{([\\w\\d\\.]+)}}/";
        //$pattern = "/{{[\\w\\d\\.]+}}/";
        $result = preg_match_all($pattern, $text, $matches);
        if ($result) {
        foreach ($matches[1] as $match) {
            $parts = explode(".", $match);
            if ($parts[0] == 'admin') {
                $admin = $replacers['admin'];
                $replaced = $admin->{$parts[1]};
                $to_replace = "{{" . $parts[0] . ".". $parts[1] . "}}";
                $quoted = preg_quote($to_replace);
                $text = preg_replace("/" . $quoted . "/", $replaced, $text);
            } elseif ($parts[0] =='lineblocs') {
                if ($parts[1] == 'signature') {
                    $to_replace = "{{lineblocs.signature}}";
                    $signature = $this->createLBSignature($replacers['admin']);
                    $text = preg_replace("/" . preg_quote($to_replace) . "/", $signature, $text);

                }
            } elseif ($parts[0] =='user') {
                $user = $replacers['user'];
                $replaced = $user->{$parts[1]};
                $to_replace = "{{" . $parts[0] . ".". $parts[1] . "}}";
                $text = preg_replace("/" . preg_quote($to_replace) . "/", $replaced, $text);

            }
        }
        }
        return $text;
    }

    public function edit_flow(WorkspaceRoutingFlow $workspaceflow)
    {
        $flowId = $workspaceflow->flow_id;
        return view('admin.sipcountry.edit_flow', compact('flowId'));
    }

    public function create_flow_for_country(Request $request)
    {
        $iso = $request->get('countryiso');
        $user = \Auth::user();
        $country = SIPCountry::where('iso', $iso)->first();
        $flow = RouterFlow::create([
            'name' => 'flow for country: ' . $country->name,
            'flow_json' => NULL
        ]);
        $workspace_flow = WorkspaceRoutingFlow::create([
            'country_id' => $country->id,
            'dest_code' => $country->country_code,
            'flow_id' => $flow->id
        ]);

        $flowId = $workspace_flow->flow_id;
        return view('admin.sipcountry.edit_flow', compact('flowId'));
    }



    public function send_email(Request $request, User $user)
    {
        $subject = $request->get("subject");
        $to = $request->get("to");
        $body = $request->get("body");
        $admin = Auth::user();
        //replacements
        $replacers = compact('user', 'admin');
        $subject = $this->replaceEmailTexts($subject, $replacers);
        $body = $this->replaceEmailTexts($body, $replacers);
        $data = [
            'subject' => $subject,
            'body' => $body
        ];
        Mail::send('emails.admin_email', $data, function($m) use ($subject, $to, $admin, $user) {
            $m->from($admin->email, $admin->getName());
            $m->to($user->email, $user->getName());
            $m->subject($subject);
        });
    }


}
