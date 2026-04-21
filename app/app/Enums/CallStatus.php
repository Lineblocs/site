<?php

namespace App\Enums;

/**
 * Call Lifecycle Statuses
 */
abstract class CallStatus
{
    public const RINGING = 'RINGING';
    public const STARTED = 'STARTED';
    public const ENDED = 'ENDED';
    public const BUSY = 'BUSY';
    public const MISSED = 'MISSED';
    public const REJECTED = 'REJECTED';

    public static function all(): array
    {
        return [
            self::RINGING,
            self::STARTED,
            self::ENDED,
            self::BUSY,
            self::MISSED,
            self::REJECTED,
        ];
    }
}