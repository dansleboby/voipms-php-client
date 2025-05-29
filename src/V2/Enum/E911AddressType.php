<?php

namespace VoipMs\V2\Enum;

/**
 * Represents E911 address type options.
 * Values should be confirmed with the e911AddressTypes API method or documentation.
 * These often correspond to types like 'Residential', 'Business', 'Other'.
 */
enum E911AddressType: string
{
    /** Residential address type. */
    case RESIDENTIAL = 'Residential';

    /** Business address type. */
    case BUSINESS = 'Business';

    /** Other address type. */
    case OTHER = 'Other'; // Common fallback

    /** Government address type. */
    case GOVERNMENT = 'Government'; // Possible type

    /** School address type. */
    case SCHOOL = 'School'; // Possible type
}
