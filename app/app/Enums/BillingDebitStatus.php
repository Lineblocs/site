<?php

namespace App\Enums;

/**
 * Service Billing Statuses
 * Used for tracking the billing state of records like calls, recordings, and DID rentals.
 */
abstract class ServiceBillingStatus
{
    public const CREATED   = 'CREATED';
    public const FAILED     = 'FAILED';

    /**
     * Get all defined status values for validation.
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::CREATED,
            self::FAILED,
        ];
    }
}