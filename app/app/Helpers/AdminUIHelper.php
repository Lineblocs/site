<?php
namespace App\Helpers;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\DIDNumber;
use App\Extension;
use App\Workspace;
use App\Flow;
use App\FlowTemplate;
use App\ExtensionCode;
use Config;
use Auth;
use DB;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\User;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use DateTime;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;


final class AdminUIHelper {
  public static function getCannedEmails() {
    $emails = [];
    $domain =MainHelper::getDeploymentDomain();
    $body1 = <<<EOF
Hello {{user.first_name}},<br/><br/>

Thanks for registering on ${domain}. We are here to help and support you!. Please contact me to schedule a call to go over the system. My email is {{admin.email}}. my number is {{admin.office_number}}
<br/><br/>
{{lineblocs.signature}}
EOF;
    $emails[] = [
        'name' => 'Ask For Demo',
        'value' => 'ask-demo',
        'email_subject' => "${domain} Demo",
        'email_body' => $body1
    ];
    $body2 = <<<EOF
Hello {{user.first_name}},<br/><br/>

Below are some video introductions that will help you get started with lineblocs.<br/><br/>

Video 1 - ${domain} for Small Business<br/>

Video 2 - Using ${domain} as a call system<br/>

Video 3 - User ${domain} Review
<br/><br/>
{{lineblocs.signature}}
EOF;
    $emails[] = [
        'name' => 'Video Intros',
        'value' => 'video-intros',
        'email_subject' => sprintf("%s Video Resources", $domain),
        'email_body' => $body2
    ];

    $body3 = <<<EOF
    Hi {{user.first_name}},<br/><br/>
Hope all is well. Checking back in to see if you were interested in further discussing ${domain} for {{user.company_name}}.<br/><br/>
Let me know when it would be best to connect.<br/><br/>

{{lineblocs.signature}}
EOF;
    $emails[] = [
        'name' => 'Follow Up',
        'value' => 'follow-up',
        'email_subject' => sprintf("%s Follow Up", $domain),
        'email_body' => $body3
    ];
    $body4 = <<<EOF
    Hi {{user.first_name}},<br/><br/>

Hope you’ve been well. I wanted to share with you our latest news about ${domain}<br/><br/>

How are things coming along on your end? Any interest in further discussing ${domain}?<br/><br/>

{{lineblocs.signature}}
EOF;
    $emails[] = [
        'name' => 'Follow Up 2',
        'value' => 'follow-up-2',
        'email_subject' => "${domain} Latest News Follow Up",
        'email_body' => $body4
    ];
  $body5 = <<<EOF
    {{user.first_name}},<br/><br/>

I wanted to make one last attempt to get in touch regarding ${domain}. If you’re interested in reviewing the platform, let me know if we can schedule a call in May.<br/>
If I don't hear back, I'll assume the team already has an excellent resource for a cloud communications tool.<br/><br/>

{{lineblocs.signature}}
EOF;
    $emails[] = [
        'name' => 'Still Interested',
        'value' => 'still-interested',
        'email_subject' => 'Are you still interested ?',
        'email_body' => $body5
    ];



    return $emails;
  }
}
