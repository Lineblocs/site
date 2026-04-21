<?php

namespace App\Enums;

/**
 * Billable Resource Types
 */
abstract class DebitResourceType
{
    public const CALL = 'CALL';
    public const NUMBER_RENTAL = 'NUMBER_RENTAL';
    public const RECORDING = 'RECORDING';
    public const SMS = 'SMS';
    public const DATA_USAGE = 'DATA_USAGE';
    public const INBOUND_TOLL_FREE = 'INBOUND_TOLL_FREE';

    public static function all(): array
    {
        return [
            self::CALL,
            self::NUMBER_RENTAL,
            self::RECORDING,
            self::SMS,
            self::DATA_USAGE,
            self::INBOUND_TOLL_FREE,
        ];
    }
}