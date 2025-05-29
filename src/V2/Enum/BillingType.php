<?php

namespace VoipMs\V2\Enum;

/**
 * Represents billing type options.
 */
enum BillingType: int
{
    /** Per minute billing. */
    case PER_MINUTE = 1;

    /** Flat rate billing. */
    case FLAT = 2;
}
