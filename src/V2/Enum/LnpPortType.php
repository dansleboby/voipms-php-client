<?php

namespace VoipMs\V2\Enum;

/**
 * Represents LNP (Local Number Portability) port type options.
 * The specific meaning of each integer value (1-5) should be confirmed
 * from Voip.ms documentation or an API method like getLNPPortTypes.
 */
enum LnpPortType: int
{
    /** Port Type 1 (e.g., Single Line Residential). */
    case TYPE_1 = 1;

    /** Port Type 2 (e.g., Multi-Line Residential). */
    case TYPE_2 = 2;

    /** Port Type 3 (e.g., Single Line Business). */
    case TYPE_3 = 3;

    /** Port Type 4 (e.g., Multi-Line Business). */
    case TYPE_4 = 4;

    /** Port Type 5 (e.g., Toll-Free). */
    case TYPE_5 = 5;
}
