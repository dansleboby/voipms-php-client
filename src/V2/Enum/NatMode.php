<?php

namespace VoipMs\V2\Enum;

/**
 * Represents NAT (Network Address Translation) mode options.
 * Values should be confirmed with the getNAT API method.
 * Based on common Asterisk/SIP configurations, typical values might include:
 * 'yes', 'no', 'never', 'force_rport', 'comedia', 'auto_force_rport', 'auto_comedia'.
 * For simplicity, a few common ones are listed.
 */
enum NatMode: string
{
    /** Yes, enable NAT support (equivalent to force_rport,comedia in some systems). */
    case YES = 'yes';

    /** No, disable NAT support. */
    case NO = 'no';

    /** Never attempt NAT adjustments. */
    case NEVER = 'never';

    /** Force RFC3581 RPORT behavior. */
    case FORCE_RPORT = 'force_rport';

    /** Enable Comedia RTP handling. */
    case COMEDIA = 'comedia';

    /** Equivalent to force_rport,comedia. */
    case AUTO_FORCE_RPORT_COMEDIA = 'auto_force_rport,comedia'; // Common combined value
}
