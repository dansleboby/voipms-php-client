<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for call pickup behavior.
 * These values typically correspond to settings like:
 * 1 = Allow only users in same group to pickup calls
 * 2 = Allow any user in any group to pickup calls
 * 3 = Allow only users in same group to pickup calls (force strict)
 * 4 = Allow any user in any group to pickup calls (force strict)
 * The exact meanings should be confirmed with Voip.ms documentation or an API method if available.
 */
enum CallPickupBehaviorOption: int
{
    /** Allow only users in the same group to pick up calls. */
    case SAME_GROUP_ONLY = 1;

    /** Allow any user in any group to pick up calls. */
    case ANY_GROUP = 2;

    /** Allow only users in the same group to pick up calls (force strict). */
    case SAME_GROUP_ONLY_STRICT = 3;

    /** Allow any user in any group to pick up calls (force strict). */
    case ANY_GROUP_STRICT = 4;
}
