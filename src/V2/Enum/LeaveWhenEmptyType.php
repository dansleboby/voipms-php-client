<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for callers to leave a queue when it becomes empty.
 * Values should be confirmed with the getLeaveWhenEmptyTypes API method.
 */
enum LeaveWhenEmptyType: string
{
    /** Callers will leave an empty queue. */
    case YES = 'yes';

    /** Callers will not leave an empty queue. */
    case NO = 'no';

    /** Callers will strictly not leave an empty queue (e.g., no failover if it becomes empty). */
    case STRICT = 'strict';
}
