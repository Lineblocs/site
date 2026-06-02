<?php

namespace App\Enums;

/**
 * Service Plan Statuses
 */
abstract class ServicePlanStatus
{
    public const ACTIVE = 'ACTIVE';
    public const INACTIVE = 'INACTIVE';
    public const DECOMMISSIONED = 'DECOMMISSIONED';

    /**
     * Optional: Helper to get all values for validation
     */
    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::DECOMMISSIONED,
        ];
    }
}
