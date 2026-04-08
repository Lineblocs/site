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

final class EmailHelper {
    public static function sendWithPHPMailer($subject, $to, $template, $data) {
        $apiCreds = ApiCredentialKVStore::getRecord();
        $mail = new PHPMailer(true); // Enable exceptions

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = $apiCreds->smtp_host;
            $mail->SMTPAuth = true;
            $mail->Username = $apiCreds->smtp_user;
            $mail->Password = $apiCreds->smtp_password;
            $mail->Port = (int) $apiCreds->smtp_port;

            // Dynamic SSL/TLS Configuration
            // Note: 'ssl' (port 465) maps to ENCRYPTION_SMTPS
            // Note: 'tls' (port 587/2525) maps to ENCRYPTION_STARTTLS
            if ($apiCreds->smtp_tls === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else if ($apiCreds->smtp_tls === 'tls') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }

            // SSL Certificate Verification (Useful for internal relays, 
            // but use with caution on production public networks)
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            // Recipients
            $mail->setFrom($apiCreds->smtp_user, MainHelper::getSiteName());
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = view('emails.'.$template, $data)->render();

            return $mail->send();
        } catch (\Exception $e) {
            // Log the error if necessary for debugging
            return $mail->ErrorInfo;
        }
    }
    /**
     * Sends email using the native Swift Mailer library for more granular control.
     */
    public static function sendEmailDirect($subject, $to, $template, $data) {
        $customizations = CustomizationsKVStore::getRecord();
        $apiCreds = ApiCredentialKVStore::getRecord();

        Log::info("EmailHelper: Starting Direct Swift process for $to");

        try {
            // 1. Determine Encryption
            $encryption = null;
            if ($apiCreds->smtp_tls === 'tls') {
                $encryption = 'tls';
            } elseif ($apiCreds->smtp_tls === 'ssl') {
                $encryption = 'ssl';
            }

            // 2. Create the Transport
            $transport = Swift_SmtpTransport::newInstance(
                $apiCreds->smtp_host,
                2525,
                "tls"
            )
            ->setUsername($apiCreds->smtp_user)
            ->setPassword($apiCreds->smtp_password);

            // 3. Bypass SSL Verification (Direct Stream Options)
            $transport->setStreamOptions([
                'ssl' => [
                    'allow_self_signed' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ]
            ]);

            // 4. Instantiate the Mailer
            $mailer = Swift_Mailer::newInstance($transport);

            // 5. Build the Body using Laravel's View factory
            $siteName = MainHelper::getSiteName();
            $data['customizations'] = $customizations;
            $data['site_name'] = $siteName;
            
            $htmlBody = view('emails.'.$template, $data)->render();

            // 6. Construct the Message
            $message = Swift_Message::newInstance($subject)
                ->setFrom([$apiCreds->smtp_user => $siteName])
                ->setTo([$to])
                ->setBody($htmlBody, 'text/html');

            // 7. Log the Payload
            Log::info("--- Direct Swift Payload Start ---");
            Log::info($message->toString());
            Log::info("--- Direct Swift Payload End ---");

            // 8. Send
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

        Log::info("EmailHelper: Starting process for $to using {$customizations->mail_provider}");

        $data['customizations'] = $customizations;
        $data['site_name'] = MainHelper::getSiteName();

        if ($customizations->mail_provider == 'smtp-gateway') {
            try {
                // 1. Dynamic Config Mapping
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

                // --- NEW: Bypass SSL Verification ---
                Config::set('mail.stream', [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);

                // Set From address to match SMTP username
                Config::set('mail.from.address', $apiCreds->smtp_user);
                Config::set('mail.from.name', $data['site_name']);

                // 2. Refresh Mailer Service
                (new MailServiceProvider(app()))->register();

                Log::info("EmailHelper: Attempting SMTP dispatch.", [
                    'host' => Config::get('mail.host'),
                    'port' => Config::get('mail.port'),
                    'enc'  => Config::get('mail.encryption'),
                    'username' => Config::get('mail.username'),
                ]);

                // 3. Send and Log Payload
                Mail::send('emails.'.$template, $data, function ($message) use ($subject, $to) {
                    $message->to($to);
                    $message->subject($subject);
                    $message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));

                    // --- NEW: Dump Email Payload to Log ---
                    Log::info("--- Raw Email Payload Start ---");
                    Log::info($message->toString());
                    Log::info("--- Raw Email Payload End ---");
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
    public static function sendEmail($subject, $to, $template, $data, $mailLib='SWIFT') {
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