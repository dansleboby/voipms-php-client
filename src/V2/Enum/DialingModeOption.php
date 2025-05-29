<?php

namespace VoipMs\V2\Enum;

/**
 * Represents dialing mode options.
 */
enum DialingModeOption: int
{
    /** Main Account dialing mode. */
    case MAIN_ACCOUNT = 0;

    /** E164 dialing mode. */
    case E164 = 1;

    /** NANPA (North American Numbering Plan Administration) dialing mode. */
    case NANPA = 2;
}
