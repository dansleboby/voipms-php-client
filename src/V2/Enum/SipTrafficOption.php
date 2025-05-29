<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for enabling or disabling SIP traffic.
 */
enum SipTrafficOption: int
{
    /** SIP traffic enabled. */
    case ENABLED = 1;

    /** SIP traffic disabled. */
    case DISABLED = 0;
}
