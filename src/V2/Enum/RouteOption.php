<?php

namespace VoipMs\V2\Enum;

/**
 * Represents routing options.
 * The specific values usually correspond to internal route IDs.
 */
enum RouteOption: string
{
    // Assuming common route identifiers.
    // These should be updated based on actual values from getRoutes API method.
    case ROUTE_1 = '1';
    case ROUTE_2 = '2';
    case ROUTE_3 = '3';
    case ROUTE_4 = '4';
    case ROUTE_5 = '5';
    // Add more cases as needed based on getRoutes output
}
