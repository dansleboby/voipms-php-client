<?php

namespace VoipMs\V2\Enum;

/**
 * Represents failover header options for routing.
 * These values are typically used in parameters like 'no_answer', 'busy', 'fail', etc.
 */
enum FailoverHeader: string
{
    /** Route to Account */
    case ACCOUNT = 'account';

    /** Route to Voicemail */
    case VOICEMAIL = 'vm';

    /** Route to Forwarding */
    case FORWARDING = 'fwd';

    /** No specific routing / Hangup */
    case NONE = 'none';

    /** Route to System (e.g., system hangup) */
    case SYSTEM = 'sys';

    /** Route to Ring Group */
    case RING_GROUP = 'grp';

    /** Route to IVR */
    case IVR = 'ivr';

    /** Route to Recording */
    case RECORDING = 'recording';

    /** Route to Queue */
    case QUEUE = 'queue';

    /** Route to Callback */
    case CALLBACK = 'cb';

    /** Route to Time Condition */
    case TIME_CONDITION = 'tc';

    /** Route to DISA */
    case DISA = 'disa';
}
