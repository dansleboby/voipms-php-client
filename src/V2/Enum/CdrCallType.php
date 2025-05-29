<?php

namespace VoipMs\V2\Enum;

/**
 * Represents call type options for filtering Call Detail Records (CDRs).
 * Note: Specific DIDs can also be used for filtering but are dynamic and not part of this enum.
 */
enum CdrCallType: string
{
    /** Retrieve all calls. */
    case ALL = 'all';

    /** Retrieve only outgoing calls. */
    case OUTGOING = 'outgoing';

    /** Retrieve only incoming calls. */
    case INCOMING = 'incoming';
}
