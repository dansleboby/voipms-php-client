<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for locking international calls.
 * Values should be confirmed with the getLockInternational API method.
 */
enum LockInternationalOption: int
{
    /** International calls unlocked. */
    case UNLOCKED = 0;

    /** International calls locked. */
    case LOCKED = 1;

    /** International calls locked, allow specific countries (requires whitelist). */
    case LOCKED_ALLOW_WHITELIST = 2;

    /** International calls locked, block specific countries (requires blacklist). */
    case LOCKED_BLOCK_BLACKLIST = 3; // Assuming such an option might exist
}
