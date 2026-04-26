<?php

namespace App\Enums;

/**
 * Payment Statuses
 */
abstract class WorkspaceUserStatus
{
    public const ACTIVE = 'ACTIVE';
    public const INVITED = 'INVITED';
    public const TERMINATED = 'TERMINATED';

    /**
     * Optional: Helper to get all values for validation
     */
    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::INVITED,
            self::TERMINATED,
        ];
    }
}