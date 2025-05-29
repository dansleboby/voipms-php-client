<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for playing instructions for voicemail.
 * Values should be confirmed with the getPlayInstructions API method.
 */
enum PlayInstructionsOption: string
{
    /** Play unavailable message. */
    case UNAVAILABLE = 'u';

    /** Play standard unavailable message (e.g. "The person at extension X is unavailable"). */
    case STANDARD_UNAVAILABLE = 'su';

    /** Play busy message. */
    case BUSY = 'b'; // Assuming 'b' for busy

    /** Play standard busy message. */
    case STANDARD_BUSY = 'sb'; // Assuming 'sb' for standard busy

    /** Play name. */
    case NAME = 'n'; // Assuming 'n' for name
}
