<?php

namespace App\Enums;

/**
 * Payment Statuses
 */
abstract class InvoiceSource
{
    public const CREDITS = 'CREDITS';
    public const SUBSCRIPTION = 'SUBSCRIPTION';
    /**
     * Optional: Helper to get all values for validation
     */
    public static function all(): array
    {
        return [
            self::CREDITS,
            self::SUBSCRIPTION,
        ];
    }
}