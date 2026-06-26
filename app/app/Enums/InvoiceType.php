<?php

namespace App\Enums;

/**
 * Invoice Types
 */
abstract class InvoiceType
{
    public const RECURRING_BILL = 'RECURRING_BILL';
    public const ONE_TIME_UPGRADE = 'ONE_TIME_UPGRADE';
    public const ONE_TIME_CREDITS = 'ONE_TIME_CREDITS';

    /**
     * Optional: Helper to get all values for validation
     */
    public static function all(): array
    {
        return [
            self::RECURRING_BILL,
            self::ONE_TIME_UPGRADE,
            self::ONE_TIME_CREDITS,
        ];
    }
}
