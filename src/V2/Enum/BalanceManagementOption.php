<?php

namespace VoipMs\V2\Enum;

/**
 * Represents balance management options for clients.
 */
enum BalanceManagementOption: int
{
    /** Hard suspend: client account is suspended immediately when balance runs out. */
    case HARD_SUSPEND = 1;

    /** Soft suspend: client account is given a grace period or warning before suspension. */
    case SOFT_SUSPEND = 2;

    // Add other options if the API supports more, e.g., specific notification levels.
    // For now, assuming 1 and 2 are the primary ones based on common scenarios.
    // The actual values should be confirmed from getBalanceManagement API method.
}
