<?php
namespace App\Helpers;

final class AdminUIHelper
{
    public static function getCannedEmails()
    {
        $emails = [];
        $body1 = <<<EOF
Hello {{user.first_name}},<br/><br/>

Thanks for registering on Lineblocs. We are here to help and support you!. Please contact me to schedule a call to go over the system. My email is {{admin.email}}. my number is {{admin.office_number}}
<br/><br/>
{{lineblocs.signature}}
EOF;
        $emails[] = [
            'name' => 'Ask For Demo',
            'value' => 'ask-demo',
            'email_subject' => 'Lineblocs Demo',
            'email_body' => $body1,
        ];
        $body2 = <<<EOF
Hello {{user.first_name}},<br/><br/>

Below are some video introductions that will help you get started with lineblocs.<br/><br/>

Video 1 - Lineblocs for Small Business<br/>

Video 2 - Using Lineblocs as a call system<br/>

Video 3 - User Lineblocs Review
<br/><br/>
{{lineblocs.signature}}
EOF;
        $emails[] = [
            'name' => 'Video Intros',
            'value' => 'video-intros',
            'email_subject' => 'Lineblocs Video Resources',
            'email_body' => $body2,
        ];

        $body3 = <<<EOF
    Hi {{user.first_name}},<br/><br/>
Hope all is well. Checking back in to see if you were interested in further discussing Lineblocs for {{user.company_name}}.<br/><br/>
Let me know when it would be best to connect.<br/><br/>

{{lineblocs.signature}}
EOF;
        $emails[] = [
            'name' => 'Follow Up',
            'value' => 'follow-up',
            'email_subject' => 'Lineblocs Follow Up',
            'email_body' => $body3,
        ];
        $body4 = <<<EOF
    Hi {{user.first_name}},<br/><br/>

Hope you’ve been well. I wanted to share with you our latest news about Lineblocs<br/><br/>

How are things coming along on your end? Any interest in further discussing Lineblocs?<br/><br/>

{{lineblocs.signature}}
EOF;
        $emails[] = [
            'name' => 'Follow Up 2',
            'value' => 'follow-up-2',
            'email_subject' => 'Lineblocs Latest News Follow Up',
            'email_body' => $body4,
        ];
        $body5 = <<<EOF
    {{user.first_name}},<br/><br/>

I wanted to make one last attempt to get in touch regarding Lineblocs. If you’re interested in reviewing the platform, let me know if we can schedule a call in May.<br/>
If I don't hear back, I'll assume the team already has an excellent resource for a cloud communications tool.<br/><br/>

{{lineblocs.signature}}
EOF;
        $emails[] = [
            'name' => 'Still Interested',
            'value' => 'still-interested',
            'email_subject' => 'Are you still interested ?',
            'email_body' => $body5,
        ];

        return $emails;
    }
}
