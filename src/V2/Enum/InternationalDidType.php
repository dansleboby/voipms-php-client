<?php

namespace VoipMs\V2\Enum;

/**
 * Represents types of international DIDs.
 * Values should be confirmed with the getInternationalTypes API method.
 */
enum InternationalDidType: string
{
    /** Geographic DIDs are tied to a specific city or region. */
    case GEOGRAPHIC = 'GEOGRAPHIC';

    /** National DIDs are reachable from anywhere within a country at local rates. */
    case NATIONAL = 'NATIONAL';

    /** Toll-Free DIDs are free for the caller. */
    case TOLLFREE = 'TOLLFREE';
}
