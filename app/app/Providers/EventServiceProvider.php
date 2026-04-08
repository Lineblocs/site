<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener'
        ],
        */
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $loggingEnabled = config('mail.logging_enabled');
        if ($loggingEnabled) {
            // Listen for the mailer sending event in Laravel 5.1
            $events->listen('mailer.sending', function ($message) {
                Log::info('--- Email Payload Start ---');
                Log::info($message->toString());
                Log::info('--- Email Payload End ---');
            });
        }
    }
}