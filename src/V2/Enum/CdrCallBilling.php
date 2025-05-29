<?php

namespace VoipMs\V2\Enum;

/**
 * Represents call billing options for filtering Call Detail Records (CDRs).
 */
enum CdrCallBilling: string
{
    /** Retrieve all calls regardless of billing status. */
    case ALL = 'all';

    /** Retrieve only calls that were free of charge. */
    case FREE = 'free';

    /** Retrieve only calls that were billed. */
    case BILLED = 'billed';
}
