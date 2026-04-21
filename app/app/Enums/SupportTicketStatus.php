<?php

namespace App\Enums;

/**
 * Payment Statuses
 */
abstract class SupportTicketStatus
{
    public const CLOSED = 'CLOSED';
    public const OPEN = 'OPEN';
    /**
     * Optional: Helper to get all values for validation
     */
    public static function all(): array
    {
        return [
            self::CLOSED,
            self::OPEN,
        ];
    }
}