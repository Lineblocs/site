<?php

namespace App\Enums;

/**
 * Service Billing Statuses
 * Used for tracking the billing state of records like calls, recordings, and DID rentals.
 */
abstract class ServiceBillingStatus
{
    public const UNBILLED   = 'UNBILLED';
    public const BILLED     = 'BILLED';
    public const PROCESSING = 'PROCESSING';
    public const FAILED     = 'FAILED';
    public const VOID       = 'VOID';

    /**
     * Get all defined status values for validation.
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::UNBILLED,
            self::BILLED,
            self::PROCESSING,
            self::FAILED,
            self::VOID,
        ];
    }
}