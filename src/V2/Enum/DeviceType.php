<?php

namespace VoipMs\V2\Enum;

/**
 * Represents device type options.
 * Values should be confirmed with the getDeviceTypes API method.
 */
enum DeviceType: int
{
    /** Represents an ATA (Analog Telephone Adapter). */
    case ATA = 1;

    /** Represents a SIP Phone. */
    case SIP_PHONE = 2;

    /** Represents an IAX2 Device. */
    case IAX2_DEVICE = 3;

    /** Represents a Softphone. */
    case SOFTPHONE = 4;

    /** Represents a Mobile Device. */
    case MOBILE = 5;

    /** Represents a Server. */
    case SERVER = 6;

    /** Represents 'Other' device type. */
    case OTHER = 7;
}
