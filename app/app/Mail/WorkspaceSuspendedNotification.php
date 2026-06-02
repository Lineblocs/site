<?php

namespace App\Mail;

use App\Helpers\EmailHelper;

class WorkspaceSuspendedNotification
{
    const SUBJECT = 'Account Suspended: Billing Action Required';
    const TEMPLATE = 'workspace_account_suspended';

    public static function sendTo($email, array $data)
    {
        return EmailHelper::sendEmail(
            self::SUBJECT,
            $email,
            self::TEMPLATE,
            $data
        );
    }
}
