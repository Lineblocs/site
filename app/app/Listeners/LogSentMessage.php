<?php

namespace App\Listeners;

use App\Events\Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogSentMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSending  $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        //
        Log::info('Email being sent:', [
            'to'      => $event->message->getTo(),
            'subject' => $event->message->getSubject(),
            'payload' => $event->message->toString(), // Full RFC822 payload
        ]);
    }
}
