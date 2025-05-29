<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for allowing callers to join a queue when it's empty.
 * Values should be confirmed with the getJoinWhenEmptyTypes API method.
 */
enum JoinWhenEmptyType: string
{
    /** Callers can join an empty queue. */
    case YES = 'yes';

    /** Callers cannot join an empty queue. */
    case NO = 'no';

    /** Callers cannot join an empty queue and are routed to failover (strict). */
    case STRICT = 'strict';

    /** Callers can join an empty queue, but only if an agent is logged in (e.g. 'loose').
     * This is a common alternative, adding it as a placeholder.
     */
    case LOOSE = 'loose';
}
