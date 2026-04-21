<?php

namespace App\Enums;

/**
 * Payment Statuses
 */
abstract class DIDNumberAvailability
{
    public const READY_TO_USE = 'READY_TO_USE';
    public const PROVISIONING = 'PROVISIONING';
    public const UNAVAILABLE = 'UNAVAILABLE';
    public const PENDING_IN_REVIEW = 'PENDING_IN_REVIEW';
    public const REVIEW_FAILED_REFUNDED = 'REVIEW_FAILED_REFUNDED';
    /**
     * Optional: Helper to get all values for validation
     */
    public static function all(): array
    {
        return [
            self::READY_TO_USE,
            self::PROVISIONING,
            self::UNAVAILABLE,
            self::PENDING_IN_REVIEW,
            self::REVIEW_FAILED_REFUNDED,
        ];
    }
}