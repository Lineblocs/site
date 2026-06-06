<?php

namespace App\Enums;

/**
 * Workspace suspension statuses.
 */
abstract class WorkspaceSuspensionStatus
{
    public const INITIATED = 'INITIATED';
    public const SUSPENDED = 'SUSPENDED';
    public const LIFTED = 'LIFTED';

    public static function all(): array
    {
        return [
            self::INITIATED,
            self::SUSPENDED,
            self::LIFTED,
        ];
    }

    public static function activeValues(): array
    {
        return [
            self::SUSPENDED,
            true,
            1,
            '1',
        ];
    }

    public static function activeDatabaseValues(): array
    {
        return [
            self::SUSPENDED,
            '1',
        ];
    }

    public static function isActive($status): bool
    {
        return in_array($status, [
            self::SUSPENDED,
            true,
            1,
            '1',
        ], true);
    }

    public static function label($status): string
    {
        if (self::isActive($status)) {
            return 'Suspended';
        }

        if ($status === self::INITIATED) {
            return 'Initiated';
        }

        return 'Lifted';
    }
}
