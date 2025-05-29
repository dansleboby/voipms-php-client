<?php

namespace VoipMs\V2\Enum;

/**
 * Represents search type options.
 */
enum SearchType: string
{
    case STARTS_WITH = 'starts';
    case CONTAINS = 'contains';
    case ENDS_WITH = 'ends';
}
