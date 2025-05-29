<?php

namespace VoipMs\V2\Enum;

/**
 * Represents enable/disable options for various SMS settings.
 */
enum SmsEnableOption: int
{
    /** Setting is enabled. */
    case ENABLED = 1;

    /** Setting is disabled. */
    case DISABLED = 0;
}
