<?php

namespace App\Enums;

/**
 * Payment Statuses
 */
abstract class PaymentStatus
{
    public const PENDING = 'PENDING';
    public const PAID = 'PAID';
    public const FAILED = 'FAILED';
    public const CANCELLED = 'CANCELLED';
    public const REFUNDED = 'REFUNDED';

    /**
     * Optional: Helper to get all values for validation
     */
    public static function all(): array
    {
        return [
            self::PENDING,
            self::PAID,
            self::FAILED,
            self::CANCELLED,
            self::REFUNDED,
        ];
    }
}