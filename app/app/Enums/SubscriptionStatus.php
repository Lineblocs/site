<?php

namespace App\Enums;

/**
 * Subscription Statuses
 */
abstract class SubscriptionStatus
{
    public const ACTIVE = 'ACTIVE';
    public const INACTIVE = 'INACTIVE';
    public const CANCELLED = 'CANCELLED';
    /**
     * Optional: Helper to get all values for validation
     */
    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::CANCELLED,
        ];
    }
}