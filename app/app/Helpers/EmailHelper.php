<?php

namespace App\Helpers;

use App\Helpers\MainHelper;
use App\CustomizationsKVStore;
use App\ApiCredentialKVStore;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\MailServiceProvider;
use PHPMailer\PHPMailer\PHPMailer;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;
use Exception;
use Illuminate\Database\Eloquent\Model;

final class EmailHelper {

    /**
     * Categorized mappings matching the Eloquent model attributes / HTML form input names.
     * Removed the 'array' type hint from the property definition for maximum PHP 7.4 compliance.
     *
     * @var array
     */
    private static $categorizedEmails = [
        'auditing' => [
            'admin_email',
            'app_feedback_request',
            'call_activity_alert',
            'call_quality_survey',
            'contact',
            'contact_confirm',
            'support_ticket_created',
            'support_ticket_updated',
            'usage_trigger',
        ],
        'account_changes' => [
            'billing_agreement_cancelled',
            'billing_failed',
            'card_expiring',
            'deactivated_account',
            'did_purchased',
            'failed_upgrade',
            'free_trial_expiring',
            'inactive_user',
            'one_time_login_link',
            'password',
            'password_reset',
            'password_was_reset',
            'payment_receipt',
            'plan_upgraded',
            'quote',
            'quote_confirm',
            'reactivated_account',
            'service_plan_being_migrated',
            'two_factor_acknowledgement',
            'unknown_device_login',
            'verify_email',
            'welcome_email',
        ],
        'workspace_changes' => [
            'extension_created',
            'invited_to_workspace',
            'phone_created',
            'sip_credentials',
            'workspace_account_suspended',
            'workspace_invoices',
            'workspace_suspended_admin',
        ],
        'system_status_updates' => [
            'alert_email',
            'port_started',
            'ports_status_completed',
            'ports_status_confirmed',
            'ports_status_needs_info',
            'ports_status_received',
            'ports_status_submitted',
            'sys_update',
            'test_email',
        ],
        'debugger' => [
            'bug_report',
            'debugger_error',
        ],
    ];

    /**
     * Check if a template falls under a category the user has disabled (set to false) on their model.
     * PHP 7.4 compliant nullable type hint syntax.
     *
     * @param Model|null $user
     * @param string $templateName
     * @return bool
     */
    private static function isUnsubscribed($user, $templateName)
    {
        if (!$user) {
            return false;
        }

        foreach (self::$categorizedEmails as $category => $templates) {
            if (in_array($templateName, $templates, true)) {
                return isset($user->$category) && (bool) $user->$category === false;
            }
        }
        return false;
    }

    public static function sendWithPHPMailer($subject, $to, $template, $data) {
        $apiCreds = ApiCredentialKVStore::getRecord();
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $apiCreds->smtp_host;
            $mail->SMTPAuth = true;
            $mail->Username = $apiCreds->smtp_user;
            $mail->Password = $apiCreds->smtp_password;
            $mail->Port = (int) $apiCreds->smtp_port;

            if ($apiCreds->smtp_tls === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else if ($apiCreds->smtp_tls === 'tls') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            $mail->setFrom($apiCreds->smtp_user, MainHelper::getSiteName());
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = view('emails.'.$template, $data)->render();

            return $mail->send();
        } catch (\Exception $e) {
            return $mail->ErrorInfo;
        }
    }

    public static function sendEmailDirect($subject, $to, $template, $data) {
        $apiCreds = ApiCredentialKVStore::getRecord();
        Log::info("EmailHelper: Starting Direct Swift process for $to");

        try {
            $transport = Swift_SmtpTransport::newInstance(
                $apiCreds->smtp_host,
                2525,
                "tls"
            )
            ->setUsername($apiCreds->smtp_user)
            ->setPassword($apiCreds->smtp_password);

            $transport->setStreamOptions([
                'ssl' => [
                    'allow_self_signed' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ]);

            $mailer = Swift_Mailer::newInstance($transport);
            $siteName = MainHelper::getSiteName();
            $htmlBody = view('emails.'.$template, $data)->render();

            $message = Swift_Message::newInstance($subject)
                ->setFrom([$apiCreds->smtp_user => $siteName])
                ->setTo([$to])
                ->setBody($htmlBody, 'text/html');

            $result = $mailer->send($message);
            Log::info("EmailHelper: Direct Swift Dispatch successful. Units sent: $result");
            return TRUE;

        } catch (Exception $ex) {
            Log::error("EmailHelper: Direct Swift Failed.", [
                'msg' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            return $ex->getMessage();
        }
    }

    public static function sendWithSwift($subject, $to, $template, $data) {
        $customizations = CustomizationsKVStore::getRecord();
        $apiCreds = ApiCredentialKVStore::getRecord();
        $siteName = MainHelper::getSiteName();

        Log::info("EmailHelper: Starting process for $to using {$customizations->mail_provider}");

        if ($customizations->mail_provider == 'smtp-gateway') {
            try {
                Config::set('mail.driver', 'smtp');
                Config::set('mail.host', $apiCreds->smtp_host);
                Config::set('mail.port', (int) $apiCreds->smtp_port);
                Config::set('mail.username', $apiCreds->smtp_user);
                Config::set('mail.password', $apiCreds->smtp_password);
                
                $encryption = null;
                if ($apiCreds->smtp_tls === 'tls') {
                    $encryption = 'tls';
                } elseif ($apiCreds->smtp_tls === 'ssl') {
                    $encryption = 'ssl';
                }
                Config::set('mail.encryption', $encryption);

                Config::set('mail.stream', [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);

                Config::set('mail.from.address', $apiCreds->smtp_user);
                Config::set('mail.from.name', $siteName);

                (new MailServiceProvider(app()))->register();

                Log::info("EmailHelper: Attempting SMTP dispatch.", [
                    'host' => Config::get('mail.host'),
                    'port' => Config::get('mail.port'),
                    'enc'  => Config::get('mail.encryption'),
                    'username' => Config::get('mail.username'),
                ]);

                Mail::send('emails.'.$template, $data, function ($message) use ($subject, $to) {
                    $message->to($to);
                    $message->subject($subject);
                    $message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));
                });

                Log::info("EmailHelper: Dispatch successful.");
                return TRUE;

            } catch (Exception $ex) {
                Log::error("EmailHelper: SMTP Failed.", ['msg' => $ex->getMessage()]);
                return $ex->getMessage();
            }
        }
        return FALSE;
    }

    /**
     * Master send method. Intercepts unsubscribed users based on their Eloquent model boolean settings.
     * Fully compatible with scalar and nullable type hints on PHP 7.4.
     *
     * @param string $subject
     * @param string $to
     * @param string $template
     * @param array $data
     * @param Model|null $user
     * @param string $mailLib
     * @return mixed
     */
    public static function sendEmail($subject, $to, $template, $data, $mailLib='SWIFT') {
        $user = NULL;
        if (!empty($data['user']) && $data['user'] instanceof Model) {
            $user = $data['user'];
        }

        if (self::isUnsubscribed($user, $template)) {
            Log::info("EmailHelper: Dispatch skipped. User ID " . ($user->id ?? 'unknown') . " ($to) has disabled the category containing '$template'.");
            return FALSE; 
        }

        $data['site_name'] = MainHelper::getSiteName();
        $data['customizations'] = CustomizationsKVStore::getRecord();

        switch ($mailLib) {
            case 'SWIFT':
                return self::sendWithSwift($subject, $to, $template, $data);
            break;
            case 'SWIFT-DIRECT':
                return self::sendEmailDirect($subject, $to, $template, $data);
            break;
            case 'PHPMAILER':
                return self::sendWithPHPMailer($subject, $to, $template, $data);
            break;
        }
    }
}