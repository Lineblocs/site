<?php

namespace App\Enums;

/**
 * Recording Statuses
 */
abstract class RecordingStatus
{
    public const RECORDING = 'RECORDING';
    public const FINALIZED = 'FINALIZED';

    public static function all(): array
    {
        return [
            self::RECORDING,
            self::FINALIZED,
        ];
    }
}