<?php

namespace App\Enums;

/**
 * Workspace suspension statuses.
 */
abstract class WorkspaceSuspensionStatus
{
    public const NOT_SUSPENDED = '0';
    public const PENDING_SUSPENSION = 'pending_suspension';
    public const REAL_SUSPENSION = 'real_suspension';

    public static function all(): array
    {
        return [
            self::NOT_SUSPENDED,
            self::PENDING_SUSPENSION,
            self::REAL_SUSPENSION,
        ];
    }

    public static function activeValues(): array
    {
        return [
            self::REAL_SUSPENSION,
            true,
            1,
            '1',
        ];
    }

    public static function activeDatabaseValues(): array
    {
        return [
            self::REAL_SUSPENSION,
            '1',
        ];
    }

    public static function isActive($status): bool
    {
        return in_array($status, [
            self::REAL_SUSPENSION,
            true,
            1,
            '1',
        ], true);
    }

    public static function label($status): string
    {
        if (self::isActive($status)) {
            return 'Real Suspension';
        }

        if ($status === self::PENDING_SUSPENSION) {
            return 'Pending Suspension';
        }

        return 'Not Suspended';
    }
}
