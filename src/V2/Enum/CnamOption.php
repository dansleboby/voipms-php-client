<?php

namespace VoipMs\V2\Enum;

/**
 * Represents CNAM (Caller ID Name) display options for DIDs.
 */
enum CnamOption: int
{
    /** CNAM display enabled. */
    case ENABLED = 1;

    /** CNAM display disabled. */
    case DISABLED = 0;
}
