<?php

namespace VoipMs\V2\Enum;

/**
 * Represents DTMF mode options.
 * Values should be confirmed with the getDTMFModes API method.
 */
enum DtmfMode: string
{
    /** In-band DTMF. */
    case INBAND = 'inband';

    /** RFC2833 DTMF. */
    case RFC2833 = 'rfc2833';

    /** SIP INFO DTMF. */
    case INFO = 'info';

    /** Auto DTMF. */
    case AUTO = 'auto';
}
