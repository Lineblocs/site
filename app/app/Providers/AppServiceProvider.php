<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ApiCredentialKVStore;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $ssl = (int) env('APP_USE_SSL');
        if ( $ssl ) {
            \URL::forceSchema('https');
        }
        Validator::extend('turnstile', function ($attribute, $value, $parameters, $validator) {
            $creds = ApiCredentialKVStore::getRecord();
            $secret = $creds['cloudflare_secret_key'];
            $ip = request()->ip();

            // Native cURL payload request for Laravel 5.1
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://challenges.cloudflare.com/turnstile/v0/siteverify');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'secret'   => $secret,
                'response' => $value,
                'remoteip' => $ip
            ]);
            
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response) {
                $responseData = json_decode($response, true);
                return isset($responseData['success']) && $responseData['success'] === true;
            }

            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
