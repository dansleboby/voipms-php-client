<?php

namespace VoipMs\V2\Enum;

/**
 * Represents LNP (Local Number Portability) location type options.
 */
enum LnpLocationType: int
{
    /** Residential location type. */
    case RESIDENTIAL = 0;

    /** Business location type. */
    case BUSINESS = 1;
}
