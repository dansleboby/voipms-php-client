<?php

namespace VoipMs\V2\Enum;

/**
 * Represents ring strategy options for queues or ring groups.
 * Values should be confirmed with the getRingStrategies API method.
 */
enum RingStrategy: string
{
    /** Rings all available agents simultaneously. */
    case RING_ALL = 'ringall';

    /** Rings agents one by one in a round-robin fashion. */
    case ROUND_ROBIN_MEMORY = 'rrmemory'; // 'roundrobin' is also common, but Voip.ms often uses 'rrmemory'

    /** Rings agents with the fewest calls first. */
    case LEAST_RECENT = 'leastrecent';

    /** Rings agents who have been idle the longest first. */
    case FEWEST_CALLS = 'fewestcalls';

    /** Rings agents randomly. */
    case RANDOM = 'random';

    /** Rings agents in a linear order. */
    case LINEAR = 'linear'; // Or 'series'
}
