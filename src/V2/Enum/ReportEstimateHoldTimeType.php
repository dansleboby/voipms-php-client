<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for reporting estimated hold time in a queue.
 * Values should be confirmed with the getReportEstimatedHoldTime API method.
 */
enum ReportEstimateHoldTimeType: string
{
    /** Report estimated hold time always. */
    case YES = 'yes';

    /** Do not report estimated hold time. */
    case NO = 'no';

    /** Report estimated hold time only once. */
    case ONCE = 'once';
}
