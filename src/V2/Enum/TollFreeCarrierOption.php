<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for Toll-Free carrier selection.
 * These values typically correspond to:
 * -1 = Automatic
 *  0 = Carrier A (e.g., Path1/Value)
 *  1 = Carrier B (e.g., Path2/Premium)
 *  2 = Carrier C (e.g., Path3/Premium2)
 * The exact carrier names associated with 0, 1, 2 should be confirmed from Voip.ms documentation or API.
 */
enum TollFreeCarrierOption: int
{
    /** Automatic carrier selection. */
    case AUTOMATIC = -1;

    /** Carrier A (Specific name should be confirmed, e.g., Path1/Value). */
    case CARRIER_A = 0;

    /** Carrier B (Specific name should be confirmed, e.g., Path2/Premium). */
    case CARRIER_B = 1;

    /** Carrier C (Specific name should be confirmed, e.g., Path3/Premium2). */
    case CARRIER_C = 2;
}
