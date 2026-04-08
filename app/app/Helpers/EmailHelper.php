<?php

namespace App\Helpers;

use App\Helpers\MainHelper;
use App\CustomizationsKVStore;
use App\ApiCredentialKVStore;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\MailServiceProvider;
use Exception;

final class EmailHelper {
    public static function sendEmail($subject, $to, $template, $data) {
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
                
                // Updated Logic: Map dropdown strings to Laravel encryption values
                $encryption = null;
                if ($apiCreds->smtp_tls === 'tls') {
                    $encryption = 'tls';
                } elseif ($apiCreds->smtp_tls === 'ssl') {
                    $encryption = 'ssl';
                }
                
                Config::set('mail.encryption', $encryption);

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

                // 3. Send
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
}